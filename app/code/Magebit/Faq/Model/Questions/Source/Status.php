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

namespace Magebit\Faq\Model\Questions\Source;

use Magebit\Faq\Model\Questions;
use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * @var Questions
     */
    protected $faq;

    /**
     * Constructor
     *
     * @param Questions $faq
     */
    public function __construct(Questions $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->faq->getStatus();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
