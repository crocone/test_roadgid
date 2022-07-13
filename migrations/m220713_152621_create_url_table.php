<?php

class m220713_152621_create_url_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('{{%url}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull()->unique(),
            'code' => $this->string()->notNull()->unique(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%url}}');
    }
}