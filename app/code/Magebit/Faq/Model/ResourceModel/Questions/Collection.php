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

namespace Magebit\Faq\Model\ResourceModel\Questions;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magebit\Faq\Model\Questions as QuestionsModel;
use Magebit\Faq\Model\ResourceModel\Questions as QuestionsResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuestionsModel::class, QuestionsResource::class);
    }

}
