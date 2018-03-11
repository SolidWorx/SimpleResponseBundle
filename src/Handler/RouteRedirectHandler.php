<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle\Handler;

use SolidWorx\SimpleResponseBundle\ResponseHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class RouteRedirectHandler implements ResponseHandlerInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function handle($object): Response
    {
        return new RedirectResponse($this->router->generate($object->getRoute(), $object->getParameters()), $object->getStatusCode());
    }

    public function supports($object): bool
    {
        return $object instanceof RedirectResponse;
    }
}