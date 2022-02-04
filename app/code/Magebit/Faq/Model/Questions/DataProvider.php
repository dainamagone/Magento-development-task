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

namespace Magebit\Faq\Model\Questions;

use Magebit\Faq\Api\Data\QuestionsInterface;
use Magebit\Faq\Model\ResourceModel\Questions\CollectionFactory;
use Magebit\Faq\Model\Questions;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $questionsCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionsCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionsCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var Questions $questions */
        foreach ($items as $questions) {
            $this->loadedData[$questions->getId()][QuestionsInterface::QUESTION] = $questions->getData();
        }

        return $this->loadedData;
    }
}
