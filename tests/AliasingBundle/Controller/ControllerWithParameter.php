<?php

namespace Symplify\ControllerAutowire\Tests\AliasingBundle\Controller;

final class ControllerWithParameter
{
    /**
     * @var string
     */
    private $kernelRootDir;

    /**
     * @param string $kernelRootDir
     */
    public function __construct(string $kernelRootDir)
    {
        $this->kernelRootDir = $kernelRootDir;
    }

    public function someAction()
    {
    }

    public function getKernelRootDir() : string
    {
        return $this->kernelRootDir;
    }
}
