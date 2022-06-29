<?php
namespace SaberSmesem\MageBlog\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table_name = $setup->getTable("sabersmesem_mageblog_posts");
        
        if (version_compare($context->getVersion(), '1.1.1', '<')) {
            if (!$setup->tableExists($table_name)) {
                $table = $setup->getConnection()
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
                
                $setup->getConnection()->createTable($table);
    
                $setup->getConnection()->addIndex(
                    $setup->getTable($table_name),
                    $setup->getIdxName(
                        $setup->getTable($table_name),
                        ['title','slug','content','tags','featured_image'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['title','slug','content','tags','featured_image'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
    
            }

        }

        $setup->endSetup();
    }

}
