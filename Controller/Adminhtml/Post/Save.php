<?php
namespace SaberSmesem\MageBlog\Controller\Adminhtml\Post;

use \Magento\Backend\App\Action;
use \SaberSmesem\MageBlog\Helper\Debug;
use \SaberSmesem\MageBlog\Helper\StringMan;
use \SaberSmesem\MageBlog\Model\PostFactory;

class Save extends Action
{
    const ADMIN_RESOURCE = 'SaberSmesem_MageBlog::save';


    /**
     * @var \SaberSmesem\MageBlog\Model\PostFactory
     */
    protected $_postFactory;

    /**
     * @var \SaberSmesem\MageBlog\Helper\StringMan
     */
    protected $_stringMan;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       PostFactory $postFactory,
       StringMan $stringMan
    )
    {
        $this->_postFactory = $postFactory;
        $this->_stringMan = $stringMan;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('mageblog/post/add');
            return;
        }
        
        if(!$data['slug']){
            $data['slug'] = $this->_stringMan->slugify($data['title']);
        }
        
        try {
            $rowData = $this->_postFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }

            $rowData->save();
            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('mageblog/post/index');
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
