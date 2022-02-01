<?php
namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CarsRepositoryInterface
 *
 * @api
 */
interface QuestionsRepositoryInterface
{
    /**
     * Create or update an FAQ.
     *
     * @param QuestionsInterface $faq
     * @return QuestionsInterface
     */
    public function save(QuestionsInterface $faq);

    /**
     * Get an FAQ by Id
     *
     * @param int $id
     * @return QuestionsInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getById($id);

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
     * @return QuestionsInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function delete(QuestionsInterface $faq);

    /**
     * Delete an FAQ by Id
     *
     * @param int $id
     * @return QuestionsInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($id);
}
