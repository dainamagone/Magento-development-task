<?php
namespace Magebit\PageListWidget\Model\Config\Source;

class Custom implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Retrieve Custom Option array
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 1, 'label' => __('All pages')],
            ['value' => 2, 'label' => __('Specified pages')]
        ];
    }
}
