<?php

namespace VertiKnow\Scraper;

trait Feature_HasInfo {

    /**
     * var Info_Entity
     */
    protected $resourceInfo;

    protected function initFeature_HasInfo(Info_Entity &$resourceInfo) {
        $this->resourceInfo = $resourceInfo;
    }

    public function getResourceInfo() {
        return $this->resourceInfo;
    }
}
