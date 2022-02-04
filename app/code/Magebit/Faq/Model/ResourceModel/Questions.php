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

namespace Magebit\Faq\Model\ResourceModel;

use Magebit\Faq\Api\Data\QuestionsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Questions
 */
class Questions extends AbstractDb
{
    /**
     * Const for table name
     */
    const TABLE_NAME = 'magebit_faq';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, QuestionsInterface::ID);
    }
}
