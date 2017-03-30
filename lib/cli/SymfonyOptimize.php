<?php

namespace Dumkaaa\BxOptimize\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyOptimize extends Command
{
    protected function configure()
    {
        $this
            ->setName('bxoptimize:optimize')
            ->setDescription('Set up optimization')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Path to find files'
            )
            ->addArgument(
                'handlers',
                InputArgument::IS_ARRAY,
                'Array of optimizators to set up'
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $handlers = $input->getArgument('handlers');


        var_dump($path);
        var_dump($handlers);
        try {
            $finder = new \Dumkaaa\BxOptimize\Finder\FilesFinder($path);
            $handler = new \Dumkaaa\BxOptimize\Handler\HandlerProcessor($handlers);

            $optimizer = new \Dumkaaa\BxOptimize\Optimizer($finder, $handler);
            $optimizer->optimize();

            $output->writeln('<info>BxOptimization set up.</info>');

        } catch (\Exception $e) {
            $output->writeln('<error>'.get_class($e).': '.$e->getMessage().'</error>');
        }
    }

}