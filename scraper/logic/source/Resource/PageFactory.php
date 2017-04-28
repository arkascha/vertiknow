<?php

namespace VertiKnow\Scraper;

class Resource_PageFactory {

    public function create(int $resourceType, Worker_Fetcher_EntityFactory $fetcherFactory): Resource_Page {
        switch($resourceType) {
            case Resource_PageType::MOCK:
                return new Resource_Mock_Page($fetcherFactory);
            case Resource_PageType::SCHACHBURG:
                return new Resource_Schachburg_Page($fetcherFactory);
            default:
                throw new Exception_VertiknowStartupError(
                    sprintf("invalid value '%s' specified as resource type", $resourceType)
                );
        }
    }
}
