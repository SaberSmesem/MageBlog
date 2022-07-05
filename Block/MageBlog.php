<?php
namespace SaberSmesem\MageBlog\Block;

class MageBlog extends \Magento\Framework\View\Element\Template
{
    protected $_postCollection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \SaberSmesem\MageBlog\Model\ResourceModel\Post\Collection $postCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \SaberSmesem\MageBlog\Model\ResourceModel\Post\Collection $postCollection,
        array $data = []
    ) {
        $this->_postCollection = $postCollection;
        parent::__construct($context, $data);
        // Filter enable posts
        $this->_postCollection->addFieldToFilter('status', 1);
        
        $this->setCollection($this->_postCollection);
        $this->pageConfig->getTitle()->set(__('Magento Blog List'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            // create pager block for collection 
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'sabersmesem.mageblog.record.pager'
            )->setAvailableLimit([5=>5,10=>10,15=>15])
            ->setShowPerPage(true)
            ->setCollection(
                $this->getCollection() // assign collection to pager
            );

            // set pager block in layout
            $this->setChild('pager', $pager);
        }
        return $this;
    }
 
    /**
     * @return string
     */
    // method for get pager html
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

}
