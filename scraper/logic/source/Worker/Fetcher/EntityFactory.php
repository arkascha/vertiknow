<?php

namespace VertiKnow\Scraper;

class Worker_Fetcher_EntityFactory {

    public function create(int $fetcherType): Worker_Fetcher_Entity {
        switch($fetcherType) {
            case Worker_Fetcher_EntityType::GET:
                return new Worker_Fetcher_File;
            case Worker_Fetcher_EntityType::CURL:
                return new Worker_Fetcher_Curl;
            default:
                throw new Exception_VertiknowStartupError(
                    sprintf("invalid value '%s' specified as fetcher worker type", $fetcherType)
                );
        }
    }
}
