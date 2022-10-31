<?php
declare(strict_types=1);

use Robo\Symfony\ConsoleIO;
use Robo\Tasks;

class RoboFile extends Tasks
{
    function hello(ConsoleIO $io, $world)
    {
        $io->say("Hello, $world");
    }
}

