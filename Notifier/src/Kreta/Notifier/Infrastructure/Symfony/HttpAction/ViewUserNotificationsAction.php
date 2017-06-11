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

namespace Kreta\Notifier\Infrastructure\Symfony\HttpAction;

use Kreta\Notifier\Application\Inbox\Notification\ViewUserNotificationsQuery;
use Kreta\SharedKernel\Application\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class ViewUserNotificationsAction
{
    private $queryBus;
    private $userId;

    public function __construct(TokenStorageInterface $tokenStorage, QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
        $this->userId = $tokenStorage->getToken()->getUser()->getUsername();
    }

    public function __invoke(Request $request) : JsonResponse
    {
        $offset = $request->query->getInt('offset', 0);
        $limit = $request->query->getInt('limit', 50);
        $status = $request->query->get('status');

        $this->queryBus->handle(
            new ViewUserNotificationsQuery(
                $this->userId,
                $offset,
                $limit,
                $status
            ),
            $notifications
        );

        return new JsonResponse($notifications);
    }
}
