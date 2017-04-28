<?php

namespace VertiKnow\Scraper;

class Worker_Fetcher_File
    extends Worker_Fetcher_Entity {

    public function fetchContent(string $url): string {
        $content = \file_get_contents($url);
        if ( ! $content) {
            throw new Exception VertiknowRuntimeError(sprintf("failed to fetch content from url '%s'", $url))
        }
        return $content;
    }
}
