<?php
/**
 * @copyright Copyright (c) 2021 Magebit (https://magebit.com/)
 * @author    <daina.magone@magebit.com>
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Magebit\Faq\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Magebit\Faq\Api\QuestionsRepositoryInterface;
use Magebit\Faq\Api\Data\QuestionsInterface;
use Magebit\Faq\Api\Data\QuestionsInterfaceFactory;
use Magebit\Faq\Api\Data\QuestionsSearchResultsInterfaceFactory;
use Magebit\Faq\Model\ResourceModel\Questions as ObjectResourceModel;
use Magebit\Faq\Model\ResourceModel\Questions\CollectionFactory;


/**
 * Class QuestionsRepository
 */
class QuestionsRepository implements QuestionsRepositoryInterface
{
    /**
     * @var QuestionsInterfaceFactory
     */
    private $objectFactory;

    /**
     * @var ObjectResourceModel
     */
    protected $objectResourceModel;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var QuestionsSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * CarsRepository constructor.
     *
     * @param ObjectResourceModel $objectResourceModel
     * @param QuestionsInterfaceFactory $objectFactory
     * @param CollectionFactory $collectionFactory
     * @param QuestionsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        ObjectResourceModel $objectResourceModel,
        QuestionsInterfaceFactory $objectFactory,
        CollectionFactory $collectionFactory,
        QuestionsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->objectResourceModel = $objectResourceModel;
        $this->objectFactory        = $objectFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor  = $collectionProcessor;
    }

    /**
     * @inheritDoc
     *
     * @throws CouldNotSaveException
     */
    public function save(QuestionsInterface $faq): QuestionsInterface
    {
        try {
            $this->objectResourceModel->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save FAQ: %1', $exception->getMessage()),
                $exception
            );
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function getById($id): QuestionsInterface
    {
        $faq = $this->objectFactory->create();
        $this->objectResourceModel->load($faq, $id);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('FAQ with id "%1" does not exist.', $id));
        }
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function delete(QuestionsInterface $faq)
    {
        try {
            $this->objectResourceModel->delete($faq);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete the FAQ: %1', $exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
