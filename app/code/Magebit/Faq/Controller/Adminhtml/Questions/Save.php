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
use Magebit\Faq\Model\QuestionsRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magebit\Faq\Model\QuestionsFactory;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Save
 */
class Save extends Action implements HttpPostActionInterface
{
    protected $questionsFactory;
    protected $adapterFactory;
    protected $uploader;

    /**
     * @var QuestionsRepositoryInterface
     */
    private $questionsRepository;

    public function __construct(
        Context $context,
        QuestionsFactory $questionsFactory,
        QuestionsRepository $questionsRepository
    ) {
        parent::__construct($context);
        $this->questionsFactory = $questionsFactory;
        $this->questionsRepository = $questionsRepository;
    }

    /**
     * Save action
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $question = $this->questionsFactory->create();
            $question->setData($data[QuestionsInterface::QUESTION]);

            if(!$question->getId()) {
                $question->setId(null);
            }
            $saveData = $this->questionsRepository->save($question);

            if($saveData){
                $this->messageManager->addSuccessMessage( __('Data saved successfully!') );
            }
        }catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

       return $resultRedirect->setPath('*/*/');
    }
}
