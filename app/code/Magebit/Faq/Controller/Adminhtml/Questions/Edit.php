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

namespace Magebit\Faq\Controller\Adminhtml\Questions;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magebit\Faq\Model\Questions;
use Magebit\Faq\Api\Data\QuestionsInterface;

/**
 * Class Edit
 */
class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Questions
     */
    private $questionsModel;
    /**
     * @var Registry
     */
    private $_coreRegistry;

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param Questions $questionsModel
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Questions $questionsModel
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->questionsModel = $questionsModel;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * Edit FAQ
     * @return Page|Redirect
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam(QuestionsInterface::ID);
        $model = $this->questionsModel;

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This FAQ no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('faq', $model);

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magebit_Faq::faq');
        $resultPage->getConfig()->getTitle()->prepend(__('New FAQ'));

        if ($id) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit FAQ'));
        }
        $resultPage->addBreadcrumb(__('FAQs'), __('FAQs'));
        $resultPage->addBreadcrumb(__('FAQ'), __('FAQ'));

        return $resultPage;
    }
}
