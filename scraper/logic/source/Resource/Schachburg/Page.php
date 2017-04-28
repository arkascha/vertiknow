<?php

namespace VertiKnow\Scraper;

class Resource_Schachburg_Page
    extends Resource_Page
    implements \Iterator {

    use Feature_HasChildren, Feature_HasUrl;

    const Page_URL = 'https://www.schachburg.de/';
    const FETCHER_TYPE = Worker_Fetcher_EntityType::CURL;

    public function __construct(Worker_Fetcher_EntityFactory $fetcherFactory) {
        parent::__construct($fetcherFactory);
        $this->initFeature_HasChildren();
        $this->initFeature_HasUrl(self::Page_URL, $fetcherFactory);
    }

    protected function extractResourceInfoFromDom(\simple_html_dom &$dom) {
        // meta info from document head
        $node = $dom->find('html', 0);
        $this->resourceInfo->direction = $node->dir;
        $this->resourceInfo->language = $node->lang;

        // document content and charset
        // example: content="text/html; charset=ISO-8859-1"
        $node = $dom->find('head meta[http-equiv="Content-Type"]', 0)->content;
        list(
            $this->resourceInfo->content,
            $this->resourceInfo->charset
        ) = array_map('trim', explode(';', $node));

        // document keywords
        $node = $dom->find('head meta[name="keywords"]', 0)->content;
        $this->resourceInfo->keywords = array_map('trim', explode(',', $node));

        // document description
        $node = $dom->find('head meta[name="keywords"]', 0)->content;
        $this->resourceInfo->description = $node;
    }

    protected function extractResourceContentFromDom(\simple_html_dom &$dom) {
        $anchors = $dom->find('body ol#forums .forumtitle a');
        foreach ($anchors as $anchor) {
            // create new forum entity
            $this->resourceChildren[] = new Resource_Schachburg_Forum($anchor->href, $this->fetcherFactory);
        }
    }
}
