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

namespace Kreta\TaskManager\Domain\Model\User;

use Kreta\SharedKernel\Domain\Model\Exception;

class UserDoesNotExistException extends Exception
{
    public function __construct()
    {
        parent::__construct('User does not exist');
    }
}
