<?php

use yii\db\Schema;
use yii\db\Migration;

class m180616_164026_add_new_columns_in_user_table extends \common\components\migration\MigrationExtended
{
    public function up()
    {
        $this->addColumn('user', 'address', $this->string(190));
        $this->addColumn('user', 'way_payment', $this->tinyInteger(1));
        $this->addColumn('user', 'way_supply', $this->tinyInteger(1));
        $this->addColumn('user', 'phone', $this->string(60));
    }

    public function down()
    {
        $this->dropColumn('user', 'address');
        $this->dropColumn('user', 'way_payment');
        $this->dropColumn('user', 'way_supply');
        $this->dropColumn('user', 'phone');
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
