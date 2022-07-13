<?php

class m220713_162211_create_visits_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('{{%visits%}}', [
            'id' => $this->primaryKey(),
            'url' => $this->integer(),
            'count' => $this->integer(),
            'date' => $this->string(12),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%visits%}}');
    }
}