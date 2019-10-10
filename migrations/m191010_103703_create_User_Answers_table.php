<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%User_Answers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%questions}}`
 */
class m191010_103703_create_User_Answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%User_Answers}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'Answer' => $this->integer(1),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-User_Answers-user_id}}',
            '{{%User_Answers}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-user_id}}',
            '{{%User_Answers}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `question_id`
        $this->createIndex(
            '{{%idx-User_Answers-question_id}}',
            '{{%User_Answers}}',
            'question_id'
        );

        // add foreign key for table `{{%questions}}`
        $this->addForeignKey(
            '{{%fk-User_Answers-question_id}}',
            '{{%User_Answers}}',
            'question_id',
            '{{%questions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-user_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-User_Answers-user_id}}',
            '{{%User_Answers}}'
        );

        // drops foreign key for table `{{%questions}}`
        $this->dropForeignKey(
            '{{%fk-User_Answers-question_id}}',
            '{{%User_Answers}}'
        );

        // drops index for column `question_id`
        $this->dropIndex(
            '{{%idx-User_Answers-question_id}}',
            '{{%User_Answers}}'
        );

        $this->dropTable('{{%User_Answers}}');
    }
}
