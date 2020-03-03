<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle\Handler;

use SolidWorx\SimpleResponseBundle\Response\RouteRedirectResponse;
use SolidWorx\SimpleResponseBundle\ResponseHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class RouteRedirectHandler implements ResponseHandlerInterface
{
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function handle(Response $object): Response
    {
        /* @var RouteRedirectResponse $object */

        return $object->setTargetUrl($this->urlGenerator->generate($object->getRoute(), $object->getParameters()));
    }

    public function supports(Response $object): bool
    {
        return $object instanceof RouteRedirectResponse;
    }
}
