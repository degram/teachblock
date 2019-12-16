<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m191208_200253_add_image_column_add_posititon_column_add_city_column_add_school_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'image', $this->string()->null());
        $this->addColumn('{{%user}}', 'position', $this->string()->null());
        $this->addColumn('{{%user}}', 'city', $this->string()->null());
        $this->addColumn('{{%user}}', 'school', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'image');
        $this->dropColumn('{{%user}}', 'position');
        $this->dropColumn('{{%user}}', 'city');
        $this->dropColumn('{{%user}}', 'school');
    }
}
