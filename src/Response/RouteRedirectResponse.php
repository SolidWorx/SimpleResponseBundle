<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle\Response;

use Symfony\Component\HttpFoundation\Response;

class RouteRedirectResponse
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $route, array $parameters = [], int $statusCode = Response::HTTP_SEE_OTHER)
    {
        $this->route = $route;
        $this->statusCode = $statusCode;
        $this->parameters = $parameters;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
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

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}