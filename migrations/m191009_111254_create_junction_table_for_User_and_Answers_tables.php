<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%User_Answers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%User}}`
 * - `{{%Answers}}`
 */
class m191009_111254_create_junction_table_for_User_and_Answers_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%User_Answers}}', [
            'User_id' => $this->integer(),
            'Answers_id' => $this->integer(),
            'PRIMARY KEY(User_id, Answers_id)',
        ]);

        // creates index for column `User_id`
        $this->createIndex(
            '{{%idx-User_Answers-User_id}}',
            '{{%User_Answers}}',
            'User_id'
        );

        // add foreign key for table `{{%User}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-User_id}}',
            '{{%User_Answers}}',
            'User_id',
            '{{%User}}',
            'id',
            'CASCADE'
        );

        // creates index for column `Answers_id`
        $this->createIndex(
            '{{%idx-User_Answers-Answers_id}}',
            '{{%User_Answers}}',
            'Answers_id'
        );

        // add foreign key for table `{{%Answers}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-Answers_id}}',
            '{{%User_Answers}}',
            'Answers_id',
            '{{%Answers}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%User}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-User_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `User_id`
        $this->dropIndex(
            '{{%idx-User_Answers-User_id}}',
            '{{%User_Answers}}'
        );

        // drops foreign key for table `{{%Answers}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-Answers_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `Answers_id`
        $this->dropIndex(
            '{{%idx-User_Answers-Answers_id}}',
            '{{%User_Answers}}'
        );

        $this->dropTable('{{%User_Answers}}');
    }
}
