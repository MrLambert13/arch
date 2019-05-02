<?php

use Console\Console;

$container->setParameter('environment', 'dev');

$container->setParameter('view.directory', __DIR__ . '/../../src/View/');

$container->setParameter('order.observers',
    [
        'Service\Communication\Email',
        'Service\Communication\Sms',
    ]);

$container->setParameter('classImg', 'localhost' . '\src\View\main\Img\Homework1.png');

$container
    ->register(Console::class)
    ->addTag('console.command', array('command' => 'app:main'));