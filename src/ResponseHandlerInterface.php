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

interface ResponseHandlerInterface
{
    public function handle(Response $object): Response;

    public function supports(Response $object): bool;
}
