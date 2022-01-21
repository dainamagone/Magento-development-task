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

namespace Magebit\AttributeModel\Block;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\AbstractAttribute;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;

class AttributeList extends Template
{
    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context                      $context,
        Registry                     $registry,
        array                        $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Returns a Product
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    public function customAttributeList(): array
    {
        $product = $this->getProduct();
        $attribute_array = ['dimensions', 'color', 'material'];
        $result_array = [];
        $extra_attributes = $this->extraAttributes();
        $attrData = $product->getResource();

        foreach($attribute_array as $attribute) {
            $attribute_object = $attrData->getAttribute($attribute);

            if($attribute_object instanceof Attribute) {
                if(!empty($attribute_object->getFrontend()->getValue($product))){
                    $result_array[] = array(
                        'label' => ucfirst($attribute_object->getFrontendLabel()),
                        'value' => $attribute_object->getFrontend()->getValue($product),
                        'code'  => $attribute_object->getAttributeCode()
                    );
                } else {
                    $result_array[] = array_shift($extra_attributes);
                }
            }
        }
        return $result_array;
    }

    private function extraAttributes(): array
    {
        $product = $this->getProduct();
        $attributes = $product->getAttributes();
        $result_array = [];
        $excludeAttr = [];

        foreach ($attributes as $attribute) {
            if ($this->isVisibleOnFrontend($attribute, $excludeAttr)) {
                $value = $attribute->getFrontend()->getValue($product);

                $result_array[] = [
                    'label' => __($attribute->getStoreLabel()),
                    'value' => $value,
                    'code' => $attribute->getAttributeCode()
                ];
            }
        }
        return $result_array;
    }

    private function isVisibleOnFrontend(AbstractAttribute $attribute, array $excludeAttr): bool
    {
        return ($attribute->getIsVisibleOnFront() && !in_array($attribute->getAttributeCode(), $excludeAttr));
    }
}


