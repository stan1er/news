<?php
/**
 * Created by PhpStorm.
 * User: Стас
 * Date: 26.03.2018
 * Time: 22:17
 */

namespace App\Command;

use App\Entity\News;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateNewsCommand extends Command
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:create-news')

            ->addArgument('title', InputArgument::REQUIRED, 'The title of the news.')
            ->addArgument('text', InputArgument::REQUIRED, 'The text of the news.')
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new news.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a news...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'News Creator',
            '============',
            '',
        ]);
        $output->writeln('Title: '.$input->getArgument('title'));
        $output->writeln('Text: '.$input->getArgument('text'));
         $news = new News();

         $news->setTitle($input->getArgument('title'));
         $news->setText($input->getArgument('text'));

         // tell Doctrine you want to (eventually) save the Product (no queries yet)
         $this->entityManager->persist($news);

         // actually executes the queries (i.e. the INSERT query)
         $this->entityManager->flush();
        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('Successfully created at id: '.$news->getId());
    }
}