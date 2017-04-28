<?php

namespace VertiKnow\Scraper;

trait Feature_HasId {

    /**
     * var int
     */
    protected $resourceId;

    protected function setResourceUrl(int $resourceId) {
        $this->resourceUrl = $resourceId;
    }

    protected function getResourceId(): int {
        return $this->resourceId;
    }
}
