<?php
namespace SaberSmesem\MageBlog\Block;

class MageBlog extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getMageBlog()
	{
		return 'Module Created Successfully';
	}

}
