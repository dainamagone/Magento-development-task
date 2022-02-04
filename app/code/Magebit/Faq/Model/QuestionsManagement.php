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

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionsInterface;
use Magebit\Faq\Api\QuestionsManagementInterface;

/**
 * Class QuestionsManagement
 */
class QuestionsManagement implements QuestionsManagementInterface
{
    /**
     * @var \Magebit\Faq\Model\ResourceModel\Questions
     */
    protected $questionsRepository;

    public function __construct(
        QuestionsRepository $questionsRepository

    ) {
        $this->questionsRepository = $questionsRepository;
    }

    public function enableQuestion(QuestionsInterface $question): void
    {
        $question->setStatus(true);
        $this->questionsRepository->save($question);

    }

    public function disableQuestion(QuestionsInterface $question): void
    {
        $question->setStatus(false);
        $this->questionsRepository->save($question);
    }
}
