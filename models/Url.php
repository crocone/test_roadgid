<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property string $url
 * @property string $code
 * @property string $fullLink
 *
 */
class Url extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%url}}';
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['url', 'code'], 'filter', 'filter' => 'trim'],
            [['url', 'code'], 'required'],
            ['url', 'string', 'min' => 6, 'max' => 255],
            ['code', 'string', 'min' => 3, 'max' => 12],
            [['url', 'code'], 'unique'],

        ];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * Finds url by code.
     *
     * @param string $code
     * @return Url
     */
    public static function findByCode($code)
    {
        return static::findOne(['code' => $code]);
    }

    /**
     * Finds url by url.
     *
     * @param string $url
     * @return static|null
     */
    public static function findByUrl($url)
    {
        return static::findOne(['url' => $url]);
    }


    public function generateShortCode()
    {
        $this->code = Yii::$app->security->generateRandomString(rand(3, 6));
    }

    public function getFullLink()
    {
        return sprintf("%s/%s", Yii::$app->params['baseUrl'], $this->code);
    }
}
