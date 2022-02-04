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

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Block\Widget\Context;
use Magebit\Faq\Api\QuestionsRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
/**
 * Class Back (button in edit/new admin grid form)
 */
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

    /**
     * Get Button Data
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10,
        ];
    }

    /**
     * Get URL for back
     * @return string
     */
    public function getBackUrl(): string
    {
        return $this->getUrl('*/*/');
    }

    /**
     * Get URL
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
