<?php
namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface QuestionsSearchResultsInterface
 */
interface QuestionsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions Complete list.
     *
     * @return QuestionsInterface[]
     */
    public function getItems(): array;

    /**
     * Set questions Complete list.
     *
     * @param QuestionsInterface[] $items
     * @return $this
     */
    public function setItems(array $items): QuestionsSearchResultsInterface;

}
