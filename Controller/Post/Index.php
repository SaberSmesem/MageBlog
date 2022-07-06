<?php
namespace SaberSmesem\MageBlog\Controller\Post;

use \Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\Controller\Result\RedirectFactory;

class Index implements HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $_redirectFactory;

    /**
     * @param \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
     */
    public function __construct(
        RedirectFactory $redirectFactory
    )
    {
        $this->_redirectFactory = $redirectFactory;
    }
    /**
     * redirect action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $redirect =  $this->_redirectFactory->create();
        return $redirect->setPath('*/index/index');
    }
}