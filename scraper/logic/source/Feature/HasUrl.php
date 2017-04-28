<?php

namespace VertiKnow\Scraper;

trait Feature_HasUrl {

    /**
     * var string
     */
    protected $resourceUrl;

    /**
     * var Worker_Fetcher_EntityFactory
     */
    protected $fetcherFactory;

    protected function initFeature_HasUrl(
        string $resourceUrl,
        Worker_Fetcher_EntityFactory &$fetcherFactory
    ) {
        if (empty($resourceUrl)) {
            throw new Exception_VertiknowStartupError(sprintf(
                "failed to initialize feature 'HasUrl' due to invalid URL '%s'",
                $resourceUrl
            ));
        }
        $this->resourceUrl = $resourceUrl;

        if (empty($fetcherFactory)) {
            throw new Exception_VertiknowStartupError(sprintf(
                "failed to initialize feature 'HasUrl' due to invalid fetcher factory '%s'",
                is_object($fetcherFactory) ? get_class($fetcherFactory) : '-unknown-'
            ));
        }
        $this->fetcherFactory = $fetcherFactory;
    }

    protected function getResourceUrl(): string {
        return $this->resourceUrl;
    }

    protected function getFetcherFromFactory(int $fetcherType): Worker_Fetcher_Entity {
        return $this->fetcherFactory->create($fetcherType);
    }

    protected function fetchResourceContent(): string {
        $fetcher = $this->getFetcherFromFactory(static::getFetcherType());
        $resourceContent = $fetcher->fetchContent($this->getResourceUrl());
        return $resourceContent;
    }
}
