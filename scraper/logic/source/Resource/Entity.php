<?php

namespace VertiKnow\Scraper;

abstract class Resource_Entity {

    abstract public function process();

    public function __construct() {
        // do some logging
    }

    static public function getFetcherType(): int {
        return static::FETCHER_TYPE;
    }

    public function getResourceInfo() {
        return $this->parent->getResourceInfo();
    }
}
