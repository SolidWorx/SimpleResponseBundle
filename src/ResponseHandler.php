<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle;

use Symfony\Component\HttpFoundation\Response;

final class ResponseHandler
{
    /**
     * @var ResponseHandlerInterface[]|iterable
     */
    private iterable $handlers;

    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    public function handle(Response $object): Response
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($object)) {
                return $handler->handle($object);
            }
        }

        throw new \InvalidArgumentException(sprintf('There are no handlers available to handle object of type %s', get_class($object)));
    }
}
