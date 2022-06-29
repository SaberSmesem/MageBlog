<?php
namespace SaberSmesem\MageBlog\Model\ResourceModel\Post;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'sabersmesem_mageblog_posts_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SaberSmesem\MageBlog\Model\Post', 'SaberSmesem\MageBlog\Model\ResourceModel\Post');
    }
}
