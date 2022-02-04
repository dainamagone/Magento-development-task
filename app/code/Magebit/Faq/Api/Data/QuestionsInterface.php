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
    public function getId(): ?int;

    /**
     * Get question
     *
     * @return string|null
     */
    public function getQuestion(): ?string;

    /**
     * Get answer
     *
     * @return string|null
     */
    public function getAnswer(): ?string;

    /**
     * Is active
     *
     * @return bool|null
     */
    public function getStatus(): ?bool;

    /**
     * Get position for sort order
     *
     * @return string|null
     */
    public function getPosition(): ?string;

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set question
     *
     * @param string $question
     * @return QuestionsInterface
     */
    public function setQuestion(string $question): QuestionsInterface;

    /**
     * Set answer
     *
     * @param string $answer
     * @return QuestionsInterface
     */
    public function setAnswer(string $answer): QuestionsInterface;

    /**
     * Set is active
     *
     * @param int|bool $status
     * @return QuestionsInterface
     */
    public function setStatus($status): QuestionsInterface;

    /**
     * Set position for sort order
     *
     * @param string $position
     * @return QuestionsInterface
     */
    public function setPosition(string $position): QuestionsInterface;
}
