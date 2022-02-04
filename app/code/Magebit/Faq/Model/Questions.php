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

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magebit\Faq\Api\Data\QuestionsInterface;
use Magebit\Faq\Model\ResourceModel\Questions as ResourceModel;

/**
 * Class Questions
 */
class Questions extends AbstractModel implements QuestionsInterface, IdentityInterface
{
    const CACHE_TAG = 'magebit_faq';

    protected $_cacheTag = 'magebit_faq';

    protected $_eventPrefix = 'magebit_faq';

    /**
     * Constants for status
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Available status
     *
     * @return array
     */
    public function getAvailableStatus(): array
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

    /**
     * @inheriDoc
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData(self::ID) ?
            (int) $this->getData(self::ID) :
            $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function getQuestion(): ?string
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @inheritDoc
     */
    public function getAnswer(): ?string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): ?bool
    {
        return (bool) $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): ?string
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATE_AT);
    }

    /**
     * @inheritDoc
     */
    public function setQuestion(string $question): QuestionsInterface
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @inheritDoc
     */
    public function setAnswer(string $answer): QuestionsInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status): QuestionsInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function setPosition(string $position): QuestionsInterface
    {
        return $this->setData(self::POSITION, $position);
    }
}
