<?php
/**
 * @copyright Copyright (c) 2022 Magebit (https://magebit.com/)
 * @author    <daina.magone@magebit.com>
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Magebit\Faq\Block;

use Magebit\Faq\Model\Questions;
use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionsRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magebit\Faq\Api\Data\QuestionsInterface;

/**
 * Class QuestionsList
 */
class QuestionsList extends Template
{
    /**
     * Constants for filter criteria
     */
    const ASCENDING = 'ASC';
    const CONDITION_TYPE = 'eq';

    /**
     * @var QuestionsRepositoryInterface
     */
    private $questionsRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;


    public function __construct(
        Template\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        QuestionsRepositoryInterface $questionsRepository,
        array $data = []
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->questionsRepository = $questionsRepository;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve questions
     *
     */
    public function getQuestions()
    {
        $sortOrder = $this->sortOrderBuilder->setField(QuestionsInterface::POSITION)->setDirection(self::ASCENDING)->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(QuestionsInterface::STATUS, Questions::STATUS_ENABLED, self::CONDITION_TYPE)
            ->setSortOrders([$sortOrder]);

        $searchCriteria = $searchCriteria->create();

        $searchResult = $this->questionsRepository->getList($searchCriteria);
        if ($searchResult->getTotalCount() > 0) {
            $items = $searchResult->getItems();
        }

        return $items;
    }
}
