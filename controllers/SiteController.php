<?php

namespace app\controllers;

use app\jobs\CheckBotJob;
use app\models\Url;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    public function actionIndex($code = null)
    {
        if (is_null($code)) {
            return $this->render('/index', ['error' => false]);
        }

        $url = Url::findByCode($code);
        if (is_null($url)) {
            return $this->render('/index', ['error' => 'Ссылка не найдена']);
        }

        $headers = Yii::$app->request->headers;
        if ($headers->has('User-Agent')) {
            $this->sendToQueue($url->id, $headers->get('User-Agent'), date('Y-m'));
        }

        return $this->redirect($url->url);
    }


    public static function sendToQueue($linkId, $userAgent, $date)
    {
        Yii::$app->queue->push(new CheckBotJob(compact('linkId', 'userAgent', 'date')));
    }

}
