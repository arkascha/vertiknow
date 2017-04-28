<?php

namespace VertiKnow\Scraper;

trait Feature_HasNode {

    /**
     * var \simple_dom_element
     */
    protected $resourceNode;

    protected function setResourceUrl(\simple_dom_element $resourceNode) {
        $this->resourceNode = $resourceNode;
    }

        protected function getResourceUrl(): \simple_dom_element {
            return $this->resourceNode;
        }
}
