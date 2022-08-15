<?php
namespace SaberSmesem\MageBlog\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Debug extends AbstractHelper
{

    public function print_without_stop($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    public function print_and_stop($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit();
    }

}
