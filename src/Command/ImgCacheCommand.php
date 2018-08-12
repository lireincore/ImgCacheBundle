<?php

namespace LireinCore\ImgCacheBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use LireinCore\ImgCacheBundle\Service\ImgCacheInterface;

class ImgCacheCommand extends Command
{
    public const COMMAND_NAME = 'lireincore:imgcache:cache:clear';

    /**
     * @var ImgCacheInterface
     */
    protected $imgCache;

    /**
     * @var SymfonyStyle
     */
    protected $io;

    public function __construct(ImgCacheInterface $imgCache)
    {
        parent::__construct(self::COMMAND_NAME);

        $this->imgCache = $imgCache;
    }

    protected function configure()
    {
        parent::configure();

        $this->setDescription('Process images');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io->title('Process images...');

        /*try {
            $data = array_map(function (HealthInterface $service): HealthDataInterface {
                return $service->getHealthInfo();
            }, $this->healthServices);

            foreach ($this->senders as $sender) {
                if ($name = $sender->getName()) {
                    $this->io->writeln($name);
                }
                if ($description = $sender->getDescription()) {
                    $this->io->writeln($description);
                }
                $sender->send($data);
            }
            $this->io->success('Data is sent by all senders');
        } catch (\Throwable $exception) {
            $this->io->error('Exception occurred: ' . $exception->getMessage());
            $this->io->text($exception->getTraceAsString());
        }*/
    }
}