<?php

/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Kreta\Notifier\Infrastructure\Symfony\Framework\AppKernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', getenv('DEFAULT_NETWORK_GATEWAY')], true)
        || PHP_SAPI === 'cli-server' || getenv('SYMFONY_ENV') === 'dev'
    )
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check ' . basename(__FILE__) . ' for more information.');
}

require_once __DIR__ . '/../.././../../../../../../vendor/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
