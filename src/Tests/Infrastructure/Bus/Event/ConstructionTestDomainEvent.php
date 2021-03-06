<?php

namespace CodelyTv\Tests\Infrastructure\Bus\Event;

use CodelyTv\Infrastructure\Bus\Event\DomainEvent;

/**
 * @method string someIdentifier()
 */
final class ConstructionTestDomainEvent extends DomainEvent
{
    public static function eventName() : string
    {
        return 'construction_test';
    }

    protected function rules() : array
    {
        return [
            'someIdentifier' => ['string'],
        ];
    }
}
