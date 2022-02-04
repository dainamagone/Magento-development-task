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

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Cms\Api\Data\PageSearchResultsInterface;
use Magento\Cms\Model\PageRepository;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\App\RequestInterface;

class PageList extends Template implements BlockInterface
{
    protected $_template = "page-list.phtml";
    const DISPLAY_TYPE_SPECIFIC_PAGE = 0;
    /**
     * @var PageRepository
     */
    private $pageRepository;
    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param PageRepository $pageRepository
     * @param Template\Context $context
     * @param  RequestInterface $request
     * @param array $data
     */
    public function __construct(
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        PageRepository               $pageRepository,
        Template\Context             $context,
        RequestInterface             $request,
        array                        $data = []
    ) {
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->pageRepository = $pageRepository;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getPages(): PageSearchResultsInterface
    {
        $isAll = $this->getData('display_type');
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        $searchCriteriaBuilder->addFilter('is_active', 1);

        if($isAll == self::DISPLAY_TYPE_SPECIFIC_PAGE) {

            $cmsPagesIdentifiers = $this->getData('cms_pages');

            if($cmsPagesIdentifiers){
                $cmsPagesArray = explode(',', $cmsPagesIdentifiers);

                $searchCriteriaBuilder->addFilter('identifier', $cmsPagesArray, 'in');

            }
        }
         return $this->pageRepository->getList($searchCriteriaBuilder->create());
    }
}
