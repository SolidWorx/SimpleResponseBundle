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
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class TemplateResponseHandler implements ResponseHandlerInterface
{
    /**
     * @var EngineInterface
     */
    private $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function handle($object): Response
    {
        /* @var TemplateResponse $object */
        return $this->engine->renderResponse($object->getTemplate(), $object->getParams(), $object->getResponse());
    }

    public function supports($object): bool
    {
        return $object instanceof TemplateResponse;
    }
}