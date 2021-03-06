<?php

namespace CodelyTv\Infrastructure\Bus\Query;

use CodelyTv\Infrastructure\Bus\HandleLocator;
use RuntimeException;

final class OracleSync implements Oracle
{
    private $locator;
    private $askHasBeenCalled = false;

    public function __construct()
    {
        $this->locator = new HandleLocator();
    }

    public function register($queryClass, callable $handler)
    {
        $this->guardAskHasNotBeenCalled();

        $this->locator->add($queryClass, $handler);
    }

    public function ask(Query $query)
    {
        $this->markAsAsked();

        $handler = $this->locator->find(get_class($query));

        return $handler($query);
    }

    private function guardAskHasNotBeenCalled()
    {
        if ($this->askHasBeenCalled) {
            throw new RuntimeException('Trying to register a new handler after some query has been asked');
        }
    }

    private function markAsAsked()
    {
        if (!$this->askHasBeenCalled) {
            $this->askHasBeenCalled = true;
        }
    }
}
