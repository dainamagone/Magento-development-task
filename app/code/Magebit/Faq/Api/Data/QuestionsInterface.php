<?php

namespace Magebit\Faq\Api\Data;

/**
 * Interface QuestionsInterface
 */
interface QuestionsInterface {
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID           = 'id';
    const QUESTION     = 'question';
    const ANSWER       = 'answer';
    const STATUS       = 'status';
    const POSITION     = 'position';
    const UPDATE_AT    = 'update_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get question
     *
     * @return string|null
     */
    public function getQuestion();

    /**
     * Get answer
     *
     * @return string|null
     */
    public function getAnswer();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Get position for sort order
     *
     * @return string|null
     */
    public function getPosition();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set question
     *
     * @param string $question
     * @return QuestionsInterface
     */
    public function setQuestion($question);

    /**
     * Set answer
     *
     * @param string $answer
     * @return QuestionsInterface
     */
    public function setAnswer($answer);

    /**
     * Set is active
     *
     * @param int|bool $status
     * @return QuestionsInterface
     */
    public function setStatus($status);

    /**
     * Set position for sort order
     *
     * @param string $position
     * @return QuestionsInterface
     */
    public function setPosition($position);
}
