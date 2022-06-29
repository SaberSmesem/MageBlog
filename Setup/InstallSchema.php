<?php
namespace SaberSmesem\MageBlog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $table_name = $installer->getTable("sabersmesem_mageblog_posts");
        if (!$installer->tableExists($table_name)) {
            $table = $installer->getConnection()
                ->newTable($table_name)
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true, 
                    'unsigned' => true, 
                    'nullable' => false, 
                    'primary' => true
                ], 'ID')
                ->addColumn('title', Table::TYPE_TEXT, 255, [
                    'nullable' => false
                ], 'post title')
                ->addColumn(
					'slug',
					Table::TYPE_TEXT,
					255,
					[],
					'Post URL Slug'
				)
                ->addColumn('content', Table::TYPE_TEXT, '64k', [
                    'nullable' => false
                    ], 'post content'
                )
                ->addColumn(
					'tags',
					Table::TYPE_TEXT,
					255,
					[],
					'Post Tags'
				)
                ->addColumn(
					'featured_image',
					Table::TYPE_TEXT,
					255,
					[],
					'Post Featured Image'
				)
                ->addColumn('status', Table::TYPE_INTEGER, 1, [],'post status')
                ->addColumn(
					'created_at',
					Table::TYPE_TIMESTAMP,
					null, [
                    'nullable' => false, 
                    'default' => Table::TIMESTAMP_INIT
                    ],
					'Created At')
                ->addColumn(
					'updated_at',
					Table::TYPE_TIMESTAMP,
					null, [
                        'nullable' => false, 
                        'default' => Table::TIMESTAMP_INIT_UPDATE
                    ],
					'Updated At')
                ->setComment('Blog Posts Table');
            
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
				$installer->getTable($table_name),
				$setup->getIdxName(
					$installer->getTable($table_name),
                    ['title','slug','content','tags','featured_image'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['title','slug','content','tags','featured_image'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);

        }

        $installer->endSetup();

    }

}
