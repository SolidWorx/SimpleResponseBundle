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

final class TemplateResponse extends Response
{
    private string $template;

    private array $context;

    public function __construct(string $template = '', array $context = [], int $status = Response::HTTP_OK, array $headers = [])
    {
        $this->template = $template;
        $this->context = $context;

        parent::__construct('', $status, $headers);
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function setContext(array $context): self
    {
        $this->context = $context;

        return $this;
    }
}
