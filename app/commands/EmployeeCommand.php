<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/27/16
 * Time: 9:11 AM
 */
namespace app\commands;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


use plugins\EmployeePlugin\Models\Employee;

class EmployeeCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('app:employee-count')
            ->setDescription("Number of employees registered in the system.")
            ->setHelp("This command will count the number of employees in the system.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $employee = new Employee();
        $count = $employee->getCount($this->getSilexApplication());
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln($count);
    }
}