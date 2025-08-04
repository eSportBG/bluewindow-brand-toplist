<?php

use yii\db\Migration;

class m250804_072913_create_brand_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%brand}}', [
            'brand_id' => $this->primaryKey(),
            'brand_name' => $this->string()->notNull(),
            'brand_image' => $this->string()->notNull(),
            'brand_rating' => $this->integer()->notNull()->defaultValue(0),
            'country_code' => $this->string(2)->notNull()->defaultValue('XX'),
        ]);

        $this->createIndex(
            'idx-brand-country-rating',
            '{{%brand}}',
            ['country_code', 'brand_rating']
        );

        $this->createIndex(
            'idx-id-name-rating',
            '{{%brand}}',
            ['brand_id', 'brand_name', 'brand_rating']
        );
    }

    public function down()
    {
        $this->dropTable('{{%brand}}');
    }
}