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

namespace Magebit\Faq\Controller\Adminhtml\Questions;

use Magebit\Faq\Model\QuestionsManagement;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq\Model\ResourceModel\Questions\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class MassEnable
 */
class MassEnable extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var QuestionsManagement
     */
    private $questionsManagement;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param QuestionsManagement $questionsManagement
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        QuestionsManagement $questionsManagement
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->questionsManagement = $questionsManagement;
        parent::__construct($context);
    }
    /**
     * Execute action
     *
     * @return Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        foreach ($collection as $item) {
            $this->questionsManagement->enableQuestion($item);
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been enabled.', $collection->getSize()));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
