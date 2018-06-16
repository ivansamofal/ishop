<?php

use yii\db\Schema;
use yii\db\Migration;

class m180616_171528_add_temp_order_id_in_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'temp_order_id', $this->string(32));
    }

    public function down()
    {
       $this->dropColumn('user', 'temp_order_id');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
