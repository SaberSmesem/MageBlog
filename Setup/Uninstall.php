<?php
namespace SaberSmesem\MageBlog\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    public function __construct(){
    
    }

	public function uninstall(
		SchemaSetupInterface $setup,
		ModuleContextInterface $context
	) {

		$installer = $setup;
		$installer->startSetup();
        $table_name = $installer->getTable("sabersmesem_mageblog_posts");

		$installer->getConnection()->dropTable($table_name);

		$installer->endSetup();
	}
}
