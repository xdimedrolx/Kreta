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

namespace Kreta\Notifier\Infrastructure\Serialization\Inbox;

use Kreta\Notifier\Domain\Model\Inbox\UserSignedUp;
use Kreta\SharedKernel\Event\StoredEvent;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SymfonyUserSignedUpNormalizer implements NormalizerInterface
{
    private $nameConverter;

    public function __construct(NameConverterInterface $nameConverter)
    {
        $this->nameConverter = $nameConverter;
    }

    public function normalize($object, $format = null, array $context = []) : array
    {
        return [
            'order'       => $object->order(),
            'name'        => $object->name(),
            'type'        => $this->nameConverter->normalize(get_class($object->event())),
            'occurred_on' => $object->occurredOn()->getTimestamp(),
            'payload'     => [
                'user_id' => $object->event()->userId()->id(),
            ],
        ];
    }

    public function supportsNormalization($data, $format = null) : bool
    {
        return $data instanceof StoredEvent && $data->event() instanceof UserSignedUp;
    }
}
