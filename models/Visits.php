<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $url
 * @property string $date
 * @property integer $count
 */
class Visits extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%visits}}';
    }


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['url', 'date', 'count'], 'required'],
            [
                ['url'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Url::class,
                'targetAttribute' => ['url' => 'id']
            ],
            ['count', 'integer'],
            ['date', 'string'],
        ];
    }
}