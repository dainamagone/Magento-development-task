<?php
namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface QuestionsRepositoryInterface
 *
 */
interface QuestionsRepositoryInterface
{
    /**
     * Create or update an FAQ.
     *
     * @param QuestionsInterface $faq
     * @return QuestionsInterface
     */
    public function save(QuestionsInterface $faq): QuestionsInterface;

    /**
     * Get an FAQ by ID
     *
     * @param int $id
     * @return QuestionsInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getById(int $id): QuestionsInterface;

    /**
     * Retrieve FAQs which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete an Faq
     *
     * @param QuestionsInterface $faq
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function delete(QuestionsInterface $faq): bool;

    /**
     * Delete an FAQ by ID
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $id): bool;
}
