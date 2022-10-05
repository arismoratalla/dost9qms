<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m180112_012602_create_default_tables extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        // tbl_auth_assignment
        $this->createTable('{{%tbl_auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(11)->null(),
            'PRIMARY KEY (item_name, user_id)',
        ], $tableOptions);

        // tbl_auth_item
        $this->createTable('{{%tbl_auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->smallInteger(6)->notNull(),
            'description' => $this->text()->null(),
            'rule_name' => $this->string(64)->null(),
            'data' => $this->binary()->null(),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null(),
            'PRIMARY KEY (name)',
        ], $tableOptions);

        // tbl_auth_item_child
        $this->createTable('{{%tbl_auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY (parent, child)',
        ], $tableOptions);

        // tbl_auth_rule
        $this->createTable('{{%tbl_auth_rule}}', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->binary()->null(),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null(),
            'PRIMARY KEY (name)',
        ], $tableOptions);

        // tbl_menu
        $this->createTable('{{%tbl_menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'parent' => $this->integer(11)->null(),
            'route' => $this->string(255)->null(),
            'order' => $this->integer(11)->null(),
            'data' => $this->binary()->null(),
        ], $tableOptions);

        // tbl_package
        $this->createTable('{{%tbl_package}}', [
            'PackageID' => $this->primaryKey(),
            'PackageName' => $this->string(100)->notNull()->unique(),
            'icon' => $this->string(100)->null(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        // tbl_profile
        $this->createTable('{{%tbl_profile}}', [
            'profile_id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull()->unique(),
            'lastname' => $this->string(50)->notNull(),
            'firstname' => $this->string(50)->notNull(),
            'designation' => $this->string(50)->notNull(),
            'middleinitial' => $this->string(50)->null(),
            'rstl_id' => $this->integer(11)->notNull(),
            'lab_id' => $this->integer(11)->notNull(),
            'contact_numbers' => $this->string(100)->null(),
            'image_url' => $this->string(100)->null(),
            'avatar' => $this->string(100)->null(),
        ], $tableOptions);

        // tbl_rstl
        $this->createTable('{{%tbl_rstl}}', [
            'rstl_id' => $this->primaryKey(),
            'region_id' => $this->integer(11)->notNull(),
            'name' => $this->string(50)->notNull(),
            'code' => $this->string(10)->notNull(),
        ], $tableOptions);

        // tbl_upload_package
        $this->createTable('{{%tbl_upload_package}}', [
            'upload_id' => $this->primaryKey(),
            'package_name' => $this->string(100)->null(),
            'module_name' => $this->string(100)->null(),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null(),
        ], $tableOptions);

        // tbl_user
        $this->createTable('{{%tbl_user}}', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255)->null(),
            'email' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        // fk: tbl_auth_assignment
        $this->addForeignKey('fk_tbl_auth_assignment_item_name', '{{%tbl_auth_assignment}}', 'item_name', '{{%tbl_auth_item}}', 'name');

        // fk: tbl_auth_item
        $this->addForeignKey('fk_tbl_auth_item_rule_name', '{{%tbl_auth_item}}', 'rule_name', '{{%tbl_auth_rule}}', 'name');

        // fk: tbl_auth_item_child
        $this->addForeignKey('fk_tbl_auth_item_child_parent', '{{%tbl_auth_item_child}}', 'parent', '{{%tbl_auth_item}}', 'name');
        $this->addForeignKey('fk_tbl_auth_item_child_child', '{{%tbl_auth_item_child}}', 'child', '{{%tbl_auth_item}}', 'name');

        // fk: tbl_menu
        $this->addForeignKey('fk_tbl_menu_parent', '{{%tbl_menu}}', 'parent', '{{%tbl_menu}}', 'id');

        // fk: tbl_profile
        $this->addForeignKey('fk_tbl_profile_user_id', '{{%tbl_profile}}', 'user_id', '{{%tbl_user}}', 'user_id');
        $this->addForeignKey('fk_tbl_profile_rstl_id', '{{%tbl_profile}}', 'rstl_id', '{{%tbl_rstl}}', 'rstl_id');
    }

    public function safeDown() {
        
    }

}
