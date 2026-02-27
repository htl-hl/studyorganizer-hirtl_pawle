<?php

namespace app\controllers;

use app\models\Aufgaben;
use app\models\AufgabenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AufgabenController implements the CRUD actions for Aufgaben model.
 */
class AufgabenController extends Controller
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
     * Lists all Aufgaben models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AufgabenSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aufgaben model.
     * @param int $Aufgaben_ID Aufgaben ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Aufgaben_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($Aufgaben_ID),
        ]);
    }

    /**
     * Creates a new Aufgaben model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Aufgaben();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Aufgaben_ID' => $model->Aufgaben_ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Aufgaben model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Aufgaben_ID Aufgaben ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Aufgaben_ID)
    {
        $model = $this->findModel($Aufgaben_ID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Aufgaben_ID' => $model->Aufgaben_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Aufgaben model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Aufgaben_ID Aufgaben ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Aufgaben_ID)
    {
        $this->findModel($Aufgaben_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aufgaben model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Aufgaben_ID Aufgaben ID
     * @return Aufgaben the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Aufgaben_ID)
    {
        if (($model = Aufgaben::findOne(['Aufgaben_ID' => $Aufgaben_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
