<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

final class RouteRedirectResponse extends RedirectResponse
{
    private string $route;

    private array $parameters;

    public function __construct(string $route = '', array $parameters = [], int $status = Response::HTTP_FOUND, array $headers = [])
    {
        $this->route = $route;
        $this->parameters = $parameters;

        parent::__construct('', $status, $headers);
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }
}
