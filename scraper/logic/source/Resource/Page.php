<?php

namespace VertiKnow\Scraper;

abstract class Resource_Page
    extends Resource_Entity {

    use Feature_HasInfo;

    public function __construct() {
        parent::__construct();
        $resourceInfo = new Info_Page;
        $this->initFeature_HasInfo($resourceInfo);
    }

    public function process() {
        try {
            $resourceContent = $this->fetchResourceContent();
            $this->processResourceContent($resourceContent);
        } catch (VertiknowException $e) {
            error_log("failed to scrape forum thread content");
            throw $e;
        }
    }

    protected function processResourceContent(string $resourceContent) {
        $dom = new \simple_html_dom();
        $dom->load($resourceContent);
        $this->extractResourceInfoFromDom($dom);
        $this->extractResourceContentFromDom($dom);
    }
}
