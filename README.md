Mercure Twig Bundle
=
Developed based on https://github.com/sroze/live-twig package.

**Install:**
```
composer require bigoen/mercure-twig-bundle
```

**If you don't use Symfony Flex:**

.env.local
```dotenv
###> bigoen/mercure-twig-bundle ###
MERCURE_TWIG_PUBLISH_URL=http://mercure/.well-known/mercure
###< bigoen/mercure-twig-bundle ###
```

config/bundles.php
```php
return [
    // ...
    Bigoen\MercureTwigBundle\BigoenMercureTwigBundle::class => ['all' => true],
];
```

config/packages/bigoen_mercure_twig.yaml
```yaml
bigoen_mercure_twig:
    public_url: "%env(MERCURE_TWIG_PUBLISH_URL)%"
    # subscriber_js: '@BigoenMercureTwig\subscriber_js.html.twig'
```

How to use?
- 
**Configurations:**
- Set MERCURE_TWIG_PUBLISH_URL,
- Set subscriber_js in yaml configuration. Default: '@BigoenMercureTwig\subscriber_js.html.twig'

**Publisher Example:**
```php
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;

/** @var PublisherInterface $publisher */
$publisher(new Update('live', 'test'));
```

**Controller Example:**
```php
<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mercure", name="mercure.")
 */
class MercureController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function orderAction(): Response
    {
        return $this->render('mercure/order.html.twig');
    }
}
```

**Twig Example:**
- Set render controller,
- Set mercure topics,
- Set isAdd. Default: 0
```twig
{{ render_bigoen_mercure_twig(
    controller('App\\Controller\\MercureController::orderAction'),
    {'topics': ['live'], 'isAdd': 1}
) }}
```
