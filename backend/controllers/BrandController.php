<?php

namespace backend\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use Yii;
use common\models\Brand;

class BrandController extends ActiveController
{
    public $modelClass = Brand::class;
    public $enableCsrfValidation = false;

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(): ActiveDataProvider
    {
        $code = Yii::$app->request->getHeaders()->get('CF-IPCountry', 'BG');

        $query = Brand::find()
            ->where(['country_code' => $code])
            ->orderBy(['brand_rating' => SORT_DESC]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }

    public function actionCreate()
    {
        $body = Yii::$app->getRequest()->getBodyParams();
        Yii::info($body, __METHOD__); // logs the array to runtime/logs/app.log
        // … rest of create logic …
    }

}