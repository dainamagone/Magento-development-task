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

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magebit\Faq\Model\QuestionsFactory;

class Save extends Action
{
    protected $questionsFactory;
    protected $adapterFactory;
    protected $uploader;

    public function __construct(
        Context $context,
        QuestionsFactory $questionsFactory

    ) {
        parent::__construct($context);
        $this->questionsFactory = $questionsFactory;

    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        try {
            $model = $this->questionsFactory->create();
            $model->addData($data['question']);
            $saveData = $model->save();

            if($saveData){
                $this->messageManager->addSuccess( __('Data saved successfully!') );
            }

        }catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }

        $this->_redirect('*/*/');
    }

}
