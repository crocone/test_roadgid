<?php

namespace app\controllers;


use app\models\Url;
use yii\base\Exception;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ];
        return $behaviors;
    }

    public function actionGenerate()
    {
        $url = \Yii::$app->request->get('url', false);
        if (!$url) {
            return ['result' => 'error', 'message' => 'Переданы неверный параметры'];
        }

        $checkUrl = Url::findByUrl($url);

        if (is_null($checkUrl)) {
            $checkUrl = new Url();
            $checkUrl->url = $url;
            try {
                $checkUrl->generateShortCode();
            } catch (Exception $e) {
                return ['result' => 'error', 'message' => 'Произошла неизвестная ошибка'];
            }
            if (!$checkUrl->save()) {
                return ['result' => 'error', 'message' => 'Произошла неизвестная ошибка'];
            }
        }

        return ['result' => 'success', 'url' => $checkUrl->fullLink];
    }
}