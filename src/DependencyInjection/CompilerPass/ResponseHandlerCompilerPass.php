<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle\DependencyInjection\CompilerPass;

use SolidWorx\SimpleResponseBundle\ResponseHandler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;

class ResponseHandlerCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     * @throws ServiceNotFoundException
     * @throws InvalidArgumentException
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(ResponseHandler::class)) {
            return;
        }

        $definition = $container->getDefinition(ResponseHandler::class);

        foreach (array_keys($container->findTaggedServiceIds('response_handler.handler')) as $serviceId) {
            $definition->addMethodCall('addHandler', [new Reference($serviceId)]);
        }
    }
}