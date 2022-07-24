<?php
namespace SaberSmesem\MageBlog\Ui\Component\Listing\Post\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Content extends Column
{
    /**
    * @param ContextInterface   $context
    * @param UiComponentFactory $uiComponentFactory
    * @param array              $components
    * @param array              $data
    */

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components =[],
        array $data = []
    )
    {
       parent::__construct($context, $uiComponentFactory, $components, $data); 
    }


    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item[$name]) && strlen($item[$name])>150) {
                    $item[$name] = mb_substr($item[$name], 0, 150, 'UTF-8')."...";
                }
            }
        }

        return $dataSource;
    }

}
