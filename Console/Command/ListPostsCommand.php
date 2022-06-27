<?php
namespace SaberSmesem\MageBlog\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;

class ListPostsCommand extends Command {

    protected $_postFactory;

    public function __construct(
        \SaberSmesem\MageBlog\Model\PostFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('mageblog:list')->setDescription('List all posts titles in console.');
    }

    protected function execute(Input $input, Output $output)
    {
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        foreach($collection as $item){
            $output->writeln($item->getId().': '.$item->getTitle());
        }
    }

}