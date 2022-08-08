<?php
namespace SaberSmesem\MageBlog\Controller\Adminhtml\Post;

use \Magento\Framework\Controller\ResultFactory;

class Add extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'SaberSmesem_MageBlog::menu_mage_blog_add_row';

    const PAGE_TITLE = 'Add Post';

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {   
         /** @var \Magento\Framework\View\Result\Page $resultPage */
         $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
         $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
         $resultPage->addBreadcrumb(__(static::PAGE_TITLE), __(static::PAGE_TITLE));
         $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));

         return $resultPage;
    }

    /**
     * Is the user allowed to view the page.
    *
    * @return bool
    */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
