<?php

namespace backend\controllers;

use common\models\Attributes;
use common\models\Propeties;
use Yii;
use common\models\Board;
use backend\models\BoardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

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
                        'actions' => ['index', 'view','create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
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
     * Displays a single Board model and Updating
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        /*
        $model->scenario = $model::SCENARIO_CHANGE;
        echo '<br><br><br><br><br><pre>';
        echo var_dump($model);
        echo '</pre>';
#*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Board model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     *
    public function actionCreate()
    {
        $model = new Board();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $path = Yii::getAlias('@frontend/web/uploadimg/').$model->generateFileName().'.'.$model->image->extension;
                $model->image->saveAs($path);
                $model->attachImage($path);
                unlink($path);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
     */


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
     * Deletes an existing Board model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
