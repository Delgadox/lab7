<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Answers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%Questions}}`
 */
class m191009_111026_create_Answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Answers}}', [
            'id' => $this->primaryKey(),
            'Answer' => $this->text(),
            'question_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `question_id`
        $this->createIndex(
            '{{%idx-Answers-question_id}}',
            '{{%Answers}}',
            'question_id'
        );

        // add foreign key for table `{{%Questions}}`
        $this->addForeignKey(
            '{{%fk-Answers-question_id}}',
            '{{%Answers}}',
            'question_id',
            '{{%Questions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%Questions}}`
        $this->dropForeignKey(
            '{{%fk-Answers-question_id}}',
            '{{%Answers}}'
        );

        // drops index for column `question_id`
        $this->dropIndex(
            '{{%idx-Answers-question_id}}',
            '{{%Answers}}'
        );

        $this->dropTable('{{%Answers}}');
    }
}
