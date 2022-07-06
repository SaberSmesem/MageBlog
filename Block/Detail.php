<?php
namespace SaberSmesem\MageBlog\Block;

use SaberSmesem\MageBlog\Model\PostFactory;

class Detail extends \Magento\Framework\View\Element\Template
{
    /**
     * @var SaberSmesem\MageBlog\Model\PostFactory $_postFactory
     */
    protected $_postFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        PostFactory $postFactory,
        array $data = []
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context, $data);
    }

    public function getPost()
    {
        $request = $this->getRequest()->getParams('id');
        $post = $this->_postFactory->create()->load($request['id']);

        return $post;
    }
}
