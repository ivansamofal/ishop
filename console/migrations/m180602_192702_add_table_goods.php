<?php

use common\components\migration\MigrationExtended;

/**
 * Class m180602_192702_add_table_goods
 */
class m180602_192702_add_table_goods extends MigrationExtended
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods', [
            'id' => $this->smallInteger()->unsigned() . ' PRIMARY KEY AUTO_INCREMENT',
            'name' => $this->string(60),
            'short_description' => $this->string(255),
            'full_description' => $this->string(2000),
            'category_id' => $this->tinyInteger()->unsigned(),
            'price' => $this->decimal(2),
            'count_available' => $this->smallInteger()->unsigned(),
            'status' => $this->tinyInteger(1)->unsigned(),
            'active' => $this->boolean(),
            'country' => $this->string(50),
            'updated_at' => $this->timestamp()
        ]);

        $this->createTable('orders', [
            'id' => $this->smallInteger()->unsigned() . ' PRIMARY KEY AUTO_INCREMENT',
            'id_user' => $this->smallInteger()->unsigned(),
            'date_order' => $this->timestamp(),
            'status_order' => $this->tinyInteger(1)->unsigned(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->createTable('goods_in_orders', [
            'id' => $this->smallInteger()->unsigned() . ' PRIMARY KEY AUTO_INCREMENT',
            'good_id' => $this->smallInteger()->unsigned(),
            'order_id' => $this->smallInteger()->unsigned(),
            'count_goods' => $this->tinyInteger()->unsigned()
        ]);

        $this->createTable('categories', [
            'id' => $this->tinyInteger()->unsigned() . ' PRIMARY KEY AUTO_INCREMENT',
            'name' => $this->string(60),
            'parent_id' => $this->tinyInteger()->unsigned(),
            'active' => $this->boolean(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->createTable('reviews', [
            'id' => $this->smallInteger()->unsigned() . ' PRIMARY KEY AUTO_INCREMENT',
            'user_id' => $this->smallInteger()->unsigned(),
            'text_review' => $this->string(1000),
            'date_review' => $this->timestamp(),
            'rate_review' => $this->tinyInteger()->unsigned(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey('fk_goods_id', 'goods_in_orders', 'good_id', 'goods', 'id');
        $this->addForeignKey('fk_order_id', 'goods_in_orders', 'order_id', 'orders', 'id');
//        $this->addForeignKey('fk_user_id', 'orders', 'id_user', 'user', 'id'); //because UNSIGNED VS SIGNED
//        $this->addForeignKey('fk_reviews_id', 'reviews', 'id_user', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_goods_id', 'goods_in_orders');
        $this->dropForeignKey('fk_order_id', 'goods_in_orders');
        $this->dropForeignKey('fk_userr_id', 'orders');
        $this->dropForeignKey('fk_reviews_id', 'reviews');
        $this->dropTable('goods');
        $this->dropTable('orders');
        $this->dropTable('goods_in_orders');
        $this->dropTable('categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180602_192702_add_table_goods cannot be reverted.\n";

        return false;
    }
    */
}
