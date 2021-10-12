<?php


namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AddAdminCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'create:admin';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordEncoder;


    /**
     * CreateAdminCommand constructor.
     */
    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordEncoder )
    {
        $this->entityManager = $entityManager;
        parent::__construct();
        $this->passwordEncoder = $passwordEncoder;

    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new Admin.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a admin...')
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command
        $admin=new User();
        $helper = $this->getHelper('question');

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            '<comment>Admin Creator',
            '============',
            '</comment>',
        ]);
        $admin->setRoles(array('ROLE_ADMIN'));
        $usernameQ=new Question('Email : ');
        $username=$helper->ask($input,$output,$usernameQ);
        $admin->setEmail($username);
        $passwordQ=new Question('Password : ');
        $password=$helper->ask($input,$output,$passwordQ);
        $admin->setPassword($this->passwordEncoder->hashPassword($admin,$password));
        $this->entityManager->persist($admin);
        $this->entityManager->flush();
        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $output->write('Admin successfully created ');
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }

}