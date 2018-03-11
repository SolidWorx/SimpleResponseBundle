<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle;

use SolidWorx\SimpleResponseBundle\DependencyInjection\CompilerPass\ResponseHandlerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SimpleResponseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ResponseHandlerCompilerPass());
    }
}