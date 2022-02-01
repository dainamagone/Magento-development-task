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

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Block\Widget\Context;
use Magebit\Faq\Api\QuestionsRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back implements ButtonProviderInterface
{
    protected $context;
    protected $questionRepository;

    public function __construct(
        Context $context,
        QuestionsRepositoryInterface $questionRepository
    ) {
        $this->context = $context;
        $this->questionRepository = $questionRepository;
    }

    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10,
        ];
    }

    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
