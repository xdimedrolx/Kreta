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

namespace Kreta\Notifier\Domain\Model\Inbox\Notification;

use Kreta\SharedKernel\Domain\Model\Exception;

class NotificationStatusNotAllowed extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf('Notification status "%s" not allowed', $type));
    }
}
