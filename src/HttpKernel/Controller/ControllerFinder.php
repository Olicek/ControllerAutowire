<?php

/*
 * This file is part of Symplify
 * Copyright (c) 2015 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace Symplify\ControllerAutowire\HttpKernel\Controller;

use Nette\Caching\Storages\DevNullStorage;
use Nette\Loaders\RobotLoader;
use Symplify\ControllerAutowire\Contract\HttpKernel\ControllerFinderInterface;

final class ControllerFinder implements ControllerFinderInterface
{
    /**
     * @var string
     */
    private $namePart;

    public function __construct(string $namePart = 'Controller')
    {
        $this->namePart = $namePart;
    }

    /**
     * {@inheritdoc}
     */
    public function findControllersInDirs(array $dirs) : array
    {
        $robot = new RobotLoader();
        $robot->setCacheStorage(new DevNullStorage());
        foreach ($dirs as $dir) {
            $robot->addDirectory($dir);
        }
        $robot->ignoreDirs .= ', Tests';
        $robot->acceptFiles = '*'.$this->namePart.'.php';
        $robot->rebuild();

        return array_keys($robot->getIndexedClasses());
    }
}
