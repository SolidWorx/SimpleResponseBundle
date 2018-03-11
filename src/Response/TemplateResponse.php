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

class TemplateResponse
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $params;

    /**
     * @var Response
     */
    private $response;

    public function __construct(string $template = null, array $params = [], Response $response = null)
    {
        $this->template = $template;
        $this->params = $params;
        $this->response = $response ?: new Response();
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }
}