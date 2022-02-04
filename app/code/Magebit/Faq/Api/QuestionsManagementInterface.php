<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionsInterface;

/**
 * Interface QuestionsManagementInterface
 */
interface QuestionsManagementInterface
{
    /**
     * @param QuestionsInterface $question
     * @return void
     */
    public function enableQuestion(QuestionsInterface $question);

    /**
     * @param QuestionsInterface $question
     * @return void
     */
    public function disableQuestion(QuestionsInterface $question);
}
