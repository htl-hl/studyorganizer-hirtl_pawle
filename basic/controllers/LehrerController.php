<?php

namespace app\controllers;

use app\models\Lehrer;
use app\models\Faecher;
use app\models\LehrerHatFach;
use app\models\LehrerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LehrerController implements the CRUD actions for Lehrer model.
 */
class LehrerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Lehrer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LehrerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lehrer model.
     * @param int $L_ID L ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($L_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($L_ID),
        ]);
    }

    /**
     * Creates a new Lehrer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lehrer();

        $faecherList = ArrayHelper::map(
            Faecher::find()->all(),
            'F_Name',
            'F_Name',
        );

        $selectedFaecher = [];

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                $selectedFaecher = \Yii::$app->request->post('selectedFaecher', []);
                foreach ($selectedFaecher as $fach) {
                    $lehrerHatFach = new LehrerHatFach();
                    $lehrerHatFach->LHF_L_ID = $model->L_ID;
                    $lehrerHatFach->LHF_F_Name = $fach;
                    $lehrerHatFach->save();
                }
                return $this->redirect(['view', 'L_ID' => $model->L_ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'faecherList' => $faecherList,
            'selectedFaecher' => $selectedFaecher,
        ]);
    }

    /**
     * Updates an existing Lehrer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $L_ID L ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($L_ID)
    {
        $model = $this->findModel($L_ID);

        $faecherList = ArrayHelper::map(
            Faecher::find()->all(),
            'F_Name',
            'F_Name',
        );

        $selectedFaecher = LehrerHatFach::find()
            ->where(['LHF_L_ID' => $L_ID])
            ->select('LHF_F_Name')
            ->column();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            LehrerHatFach::deleteAll(['LHF_L_ID' => $L_ID]);
            $selectedFaecher = \Yii::$app->request->post('selectedFaecher', []);
            foreach ($selectedFaecher as $fach) {
                $lhf = new LehrerHatFach();
                $lhf->LHF_L_ID = $model->L_ID;
                $lhf->LHF_F_Name = $fach;
                $lhf->save();
            }
            return $this->redirect(['view', 'L_ID' => $model->L_ID]);
        }

        return $this->render('update', [
            'model' => $model,
            'faecherList' => $faecherList,
            'selectedFaecher' => $selectedFaecher,
        ]);
    }

    /**
     * Deletes an existing Lehrer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $L_ID L ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($L_ID)
    {
        $this->findModel($L_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lehrer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $L_ID L ID
     * @return Lehrer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($L_ID)
    {
        if (($model = Lehrer::findOne(['L_ID' => $L_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
