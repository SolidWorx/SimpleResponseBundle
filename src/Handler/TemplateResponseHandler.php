<?php

declare(strict_types=1);

/*
 * This file is part of the SimpleResponseBundle project.
 *
 * @author     Pierre du Plessis
 * @copyright  Copyright (c) SolidWorx <open-source@solidworx.co>
 */

namespace SolidWorx\SimpleResponseBundle\Handler;

use SolidWorx\SimpleResponseBundle\Response\TemplateResponse;
use SolidWorx\SimpleResponseBundle\ResponseHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class TemplateResponseHandler implements ResponseHandlerInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function handle(Response $object): Response
    {
        /* @var TemplateResponse $object */
        return $object->setContent($this->twig->render($object->getTemplate(), $object->getContext()));
    }

    public function supports(Response $object): bool
    {
        return $object instanceof TemplateResponse;
    }
}
