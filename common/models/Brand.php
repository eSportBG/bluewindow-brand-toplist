<?php

namespace common\models;
use yii\db\ActiveRecord;

class Brand extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%brand}}';
    }

    public function rules(): array
    {
        return [
            [['brand_name', 'brand_image', 'brand_rating', 'country_code'], 'required'],
            ['brand_name', 'string', 'max' => 255],
            ['brand_image', 'url'],
            ['brand_rating', 'integer', 'min' => 0, 'max' => 5],
            ['country_code', 'string', 'length' => 2],
        ];
    }

}