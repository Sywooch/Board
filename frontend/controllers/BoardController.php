<?php

namespace frontend\controllers;

use app\models\MailForm;
use common\models\Object;
use common\models\Propeties;
use common\models\Type;
use frontend\models\SearchForm;
use Yii;
use common\models\Board;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use common\models\Attributes;

/**
 * BoardController implements the CRUD actions for Board model.
 */
class BoardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['create', 'step', 'my', 'view', 'update', 'close', 'ended', 'public', 'sendmsg', 'delete', 'viewmy'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['view', 'sendmsg'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],

        ];
    }

    /**
     * Lists all Board models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Board model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $search = new SearchForm();

        $mail_model = new MailForm();

        $board_mail = $this->findModel($id);
        $board_mail->updateCounters(['looks' => 1]);
        return $this->render('view', [
            'model' => $board_mail,
            'search' => $search,
            'mail_model' => $mail_model,
        ]);
    }

    /**
     * Displays a single Board model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewmy($id)
    {
        $search = new SearchForm();

        $board_mail = $this->findModel($id);

        return $this->render('viewmy', [
            'model' => $board_mail,
            'search' => $search,

        ]);
    }

    public function actionStep()
    {
            $type = Type::find()->all();
            $object = Object::find()->orderBy('sort')->all();

            return $this->render('step', [
                'type' => $type,
                'object' => $object,
            ]);
    }

    public function actionEnded()
    {
        $models = Board::findAll(['id_user'=>Yii::$app->user->identity->id, 'enable'=>0]);

        return $this->render('ended', [
            'models' => $models,
        ]);
    }

    /**
     * Creates a new Board model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->request->post())
            return $this->redirect(['/site/index']);


        $model = new Board();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            // Save Images
            $model->image1 = UploadedFile::getInstance($model, 'image1');
            if ($model->image1) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image1->extension;
                $model->image1->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }

            $model->image2 = UploadedFile::getInstance($model, 'image2');
            if ($model->image2) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image2->extension;
                $model->image2->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            $model->image3 = UploadedFile::getInstance($model, 'image3');
            if ($model->image3) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image3->extension;
                $model->image3->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            $model->image4 = UploadedFile::getInstance($model, 'image4');
            if ($model->image4) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image4->extension;
                $model->image4->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            $model->image5 = UploadedFile::getInstance($model, 'image5');
            if ($model->image5) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image5->extension;
                $model->image5->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            // Save attributes


            // Save redirect
            Yii::$app->session->setFlash('success', '<h2 class="text-center">Ваше объявление, '. $model->name .', успешно добавлено</h2><p class="text-center">Оно будет опубликовано через 15 минут</p>');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $params = Yii::$app->request->post();
            $model->setAttribute('id_object', $params['id_object']);
            $model->setAttribute('id_type', $params['id_type']);

            if (!$model->validate(['id_object', 'id_type']))
                return $this->redirect(['/site/index']);

            if ($model->id_type==Board::TYPE_SALE)
                $model->scenario = Board::SCENARIO_SALE;
            if ($model->id_type==Board::TYPE_RENT)
                $model->scenario = Board::SCENARIO_RENT;

            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing Board model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // OldImage
        $old_images = $model->getImages();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Перебираем массив с изображениями, если отмечено удаление то удаляем
            $arrimg = [];
            $i = 0;
            foreach ($old_images as $images)
            {
                $i++;
                $arrimg[$i] = $images;
            }
            if (($model->delimg1==1)&&isset($arrimg[1]))
            {
                $model->removeImage($arrimg[1]);
            }
            if (($model->delimg2==1)&&isset($arrimg[2]))
            {
                $model->removeImage($arrimg[2]);
            }
            if (($model->delimg3==1)&&isset($arrimg[3]))
            {
                $model->removeImage($arrimg[3]);
            }
            if (($model->delimg4==1)&&isset($arrimg[5]))
            {
                $model->removeImage($arrimg[4]);
            }
            if (($model->delimg1==5)&&isset($arrimg[5]))
            {
                $model->removeImage($arrimg[5]);
            }
            // Before we need check delete image

            $model->image1 = UploadedFile::getInstance($model, 'image1');
            if ($model->image1) {
                //$model->removeImage($model->image1);
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image1->extension;
                $model->image1->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }

            $model->image2 = UploadedFile::getInstance($model, 'image2');
            if ($model->image2) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image2->extension;
                $model->image2->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            $model->image3 = UploadedFile::getInstance($model, 'image3');
            if ($model->image3) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image3->extension;
                $model->image3->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            $model->image4 = UploadedFile::getInstance($model, 'image4');
            if ($model->image4) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image4->extension;
                $model->image4->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            $model->image5 = UploadedFile::getInstance($model, 'image5');
            if ($model->image5) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image5->extension;
                $model->image5->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            // Устанавливаем первую картинку главной если сбилась
            /*
            foreach ($model->getImages() as $new_images)
            {
                if ($new_images->id) {
                    $model->setMainImage($new_images);
                }
                break;
            }
            */
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if ($model->id_type==Board::TYPE_SALE)
                $model->scenario = Board::SCENARIO_SALE;
            if ($model->id_type==Board::TYPE_RENT)
                $model->scenario = Board::SCENARIO_RENT;

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * List of my ads
     * @return string
     */
    public function actionMy()
    {
        $models = Board::findAll(['id_user'=>Yii::$app->user->identity->id, 'enable'=>1]);

        return $this->render('my', [
            'models' => $models,
        ]);
    }

    /**
     * Close active Ad
     * @param $id
     * @return \yii\web\Response
     */
    public function actionClose($id)
    {
        if ($id)
            Board::updateAll(['enable'=> 0], ['id'=>$id]);

        return $this->redirect(['my']);
    }

    /**
     * Public expire or closed Ad
     * @param $id
     * @return \yii\web\Response
     */
    public function actionPublic($id)
    {
        if ($id)
            Board::updateAll(['enable'=> 1], ['id'=>$id]);

        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * @author Nikolay
     * Send message from client to user of ad
     * @return \yii\web\Response
     */
    public function actionSendmsg()
    {
        $model_mail = new MailForm();
        if ($model_mail->load(Yii::$app->request->post()) && $model_mail->validate()) {

            $model = Board::findOne($model_mail->uid);
            $model->updateCounters(['views' => 1]);
            $model_mail->contact($model->idUser->email, $model);

            Yii::$app->session->setFlash('success', '<h2 class="text-center">Ваше сообщение для '. $model->idUser->fio .', успешно отправлено</h2>');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->goHome();

    }

    /**
     * Deletes an existing Board model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model)
        {
            Attributes::deleteAll(['id_board' => $model->id]);
            $model->removeImages();
            $model->delete();
        }


        return $this->redirect(['ended']);
    }

    /**
     * Finds the Board model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Board the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Board::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
