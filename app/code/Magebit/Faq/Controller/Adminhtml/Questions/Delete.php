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

use Magebit\Faq\Api\Data\QuestionsInterface;
use Magebit\Faq\Api\QuestionsRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;

/**
 * Class Delete
 */
class Delete extends Action
{
    /**
     * @var QuestionsRepositoryInterface
     */
    private $questionsRepository;

    /**
     * @param Action\Context $context
     * @param QuestionsRepositoryInterface $questionsRepository
     */

    public function __construct(
        Context $context,
        QuestionsRepositoryInterface $questionsRepository
    ) {
        $this->questionsRepository = $questionsRepository;
        parent::__construct($context);
    }

    /**
     * Delete FAQ
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $id = (int) $this->getRequest()->getParam(QuestionsInterface::ID);
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $this->questionsRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The FAQ has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find the FAQ specified to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
