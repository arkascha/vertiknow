<?php

namespace VertiKnow\Scraper;

abstract class Worker_Fetcher_Entity {

    const TYPE_GET = 1;
    const TYPE_CURL = 2;

    abstract public function fetchContent(string $url): string;
}
