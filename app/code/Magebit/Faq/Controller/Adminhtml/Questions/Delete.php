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

use Magebit\Faq\Model\Questions;
use Magento\Backend\App\Action;

/**
 * Class Delete
 */
class Delete extends Action
{
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magebit_Faq::delete');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $model = $this->_objectManager->create(Questions::class);
                $model->load($id);
                $model->delete();
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
