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

class ResponseHandler
{
    /**
     * @var ResponseHandlerInterface[]
     */
    private $handlers = [];

    public function __construct(array $handlers = [])
    {
        foreach ($handlers as $handler) {
            $this->addHandler($handler);
        }
    }

    /**
     * @param object $object
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function handle($object): Response
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($object)) {
                return $handler->handle($object);
            }
        }

        throw new \InvalidArgumentException(sprintf('There are no handlers available to handle object of type %s', get_class($object)));
    }

    public function addHandler(ResponseHandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }
}