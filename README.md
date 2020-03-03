Simple Response Bundle
======================

SimpleResponseBundle is a bundle for the Symfony framework which allows you to return customised response classes in your controllers/actions which reduces the amount of dependencies you controller or action needs.

Installation
------------

To install the bundle using composer, run the following command:

```bash
$ composer require solidworx/simple-response-handler
```

After you have installed the bundle, then you need to register the bundle in your application

```php
<?php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            ...
            new SolidWorx\SimpleResponseBundle\SimpleResponseBundle(),
            ...
        ];
        
        ...        
     }
}
```

Usage
-----

This bundle comes with some pre-defined handlers:

* TemplateResponse
* RouteRedirectResponse

### TemplateResponse

The `TemplateResponse` class will render a template based on the arguments to the class.
To render a template, just return an instance of the `TemplateResponse` class in your route action:

```php
<?php

// src/AppBundle/Action/MyAction.php

use SolidWorx\SimpleResponseBundle\Response\TemplateResponse;

class MyAction
{
    public function __invoke()
    {
        return new TemplateResponse('index.html.twig');
    }
}

```

When loading this action, the `index.html.twig` template will automatically be rendered without the need to include twig as a dependency in your action class.

### RouteRedirectResponse

The `RouteRedirectResponse` class will redirect to a given route name.

```php
<?php

// src/AppBundle/Action/MyAction.php

use SolidWorx\SimpleResponseBundle\Response\RouteRedirectResponse;

class MyAction
{
    public function __invoke()
    {
        return new RouteRedirectResponse('_some_route_name');
    }
}

```

When loading this action, the page will redirect to the `_some_route_name` route without the need to include the router in your action or generate the URL.

Registering custom handlers
---------------------------

To register a custom handler, you need to create a new service that has the `response_handler.handler` tag.
This class needs to implement the `SolidWorx\SimpleResponseBundle\ResponseHandlerInterface` interface

```yml
services:
    My\Custom\Handler:
        arguments: ['@doctrine.orm.entity_manager']
        tags: ['solidworx.response_handler']
            
```

You then need to create a class that will be used as the return value in your action


```php
<?php
use Symfony\Component\HttpFoundation\JsonResponse;

class DoctrineEntityResponse extends JsonResponse
{
    private $entity;
    
    public function __construct(string $entity)
    {
        $this->entity = $entity;
        parent::__construct();
    }

    public function getEntity(): string
    {
        return $this->entity;
    }
}      
```

Your handler class will add the logic to return a response object;

```php
<?php
use SolidWorx\SimpleResponseBundle\ResponseHandlerInterface;
use Symfony\Component\HttpFoundation\Response;

class Handler implements ResponseHandlerInterface
{
    private $em;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
    }
    
    public function supports(Response $object): bool
    {
        return $object instanceof DoctrineEntityReponse; // Only support responses of this type
    }
    
    public function handle(Response $object): Response
    {
        return $object->setData($this->em->getRepository($object->getEntity())->findAll()); // Return all records in the entity as a JSON response
    }
}
```

Then you can use your new class in your action:

```php
<?php

// src/AppBundle/Action/MyAction.php

class MyAction
{
    public function __invoke()
    {
        return new DoctrineEntityResponse(\App\Entity\Order::class); // Pass the Order entity which will return all orders in a JSON response
    }
}

```
