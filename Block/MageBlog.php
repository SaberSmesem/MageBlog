<?php
namespace SaberSmesem\MageBlog\Block;

class MageBlog extends \Magento\Framework\View\Element\Template
{

    protected $_postFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \SaberSmesem\MageBlog\Model\PostFactory $postFactory
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \SaberSmesem\MageBlog\Model\PostFactory $postFactory,
        array $data = []
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context, $data);
        $collection = $this->_postFactory->create()
                                        ->getCollection();
        $this->setCollection($collection);
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
