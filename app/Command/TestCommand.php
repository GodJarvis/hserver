<?php

declare(strict_types=1);

namespace App\Command;

use App\Logger\Log;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;

#[Command]
class TestCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('test:hello');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        // 从 $input 获取 name 参数
        $argument = $this->input->getArgument('name') ?? 'World';
        Log::get()->info('Hello ' . $argument);
        $this->line('Hello ' . $argument, 'info');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, '这里是对这个参数的解释']
        ];
    }
}
