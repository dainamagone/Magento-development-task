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

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionsRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;

class QuestionsList extends Template
{

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

    public function getQuestions()
    {
        $sortOrder = $this->sortOrderBuilder->setField('position')->setDirection('ASC')->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', 1, 'eq')
            ->setSortOrders([$sortOrder]);

        $searchCriteria = $searchCriteria->create();

        $searchResult = $this->questionsRepository->getList($searchCriteria);
        if ($searchResult->getTotalCount() > 0) {
            $items = $searchResult->getItems();
        }
        return $items;
    }
}
