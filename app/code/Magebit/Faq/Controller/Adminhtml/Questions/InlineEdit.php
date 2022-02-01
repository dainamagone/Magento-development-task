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
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magebit\Faq\Model\Questions;
use Magebit\Faq\Api\QuestionsRepositoryInterface as QuestionRepository;
use Magebit\Faq\Api\Data\QuestionsInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class InlineEdit
 */
class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var QuestionRepository
     */
    private $questionsRepository;

    /**
     * @param Context     $context
     * @param QuestionRepository $questionsRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        QuestionRepository $questionsRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->questionsRepository = $questionsRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute(): ResultInterface
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData(
                [
                    'messages' => [__('Please correct the data sent.')],
                    'error' => true,
                ]
            );
        }

        foreach (array_keys($postItems) as $questionsId) {
            /** @var Questions $faq */
            $faq = $this->questionsRepository->getById($questionsId);
            try {
                $faq->setData(array_merge($faq->getData(), $postItems[$questionsId]));
                $this->questionsRepository->save($faq);
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithQuestionsId(
                    $faq,
                    __($e->getMessage())
                );
                $error = true;
            }
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error' => $error,
            ]
        );
    }

    protected function getErrorWithQuestionsId(QuestionsInterface $faq, $errorText): string
    {
        return '[FAQ ID: ' . $faq->getId() . '] ' . $errorText;
    }
}
