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

namespace Magebit\Faq\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magebit\Faq\Api\Data\QuestionsInterface;
use Magebit\Faq\Model\ResourceModel\Questions as ResourceModel;

class Questions extends AbstractModel implements QuestionsInterface, IdentityInterface
{
    const CACHE_TAG = 'magebit_faq';

    protected $_cacheTag = 'magebit_faq';

    protected $_eventPrefix = 'magebit_faq';

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getStatus()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Return unique ID(s) for each object in system
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId() {
        return $this->getData(self::ID);
    }

    public function getQuestion() {
        return $this->getData(self::QUESTION);
    }

    public function getAnswer() {
        return $this->getData(self::ANSWER);
    }

    public function getPosition() {
        return $this->getData(self::POSITION);
    }

    public function getUpdatedAt() {
        return $this->getData(self::UPDATE_AT);
    }

    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }
}
