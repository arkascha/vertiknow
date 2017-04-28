<?php

namespace VertiKnow\Scraper;

class Resource_Mock_Page
    extends Resource_Page
    implements \Iterator {

    const Page_URL = 'https://example.org/';
    const FETCHER_TYPE = Worker_Fetcher_EntityType::MOCK;

    public function __construct(Worker_Fetcher_EntityFactory $fetcherFactory) {
        parent::__construct($fetcherFactory);
    }

    protected function extractResourceInfoFromDom(\simple_html_dom &$dom) {
        // meta info from document head
        $this->resourceInfo->direction = 'ltr';
        $this->resourceInfo->language = 'eng';

        // document content and charset
        // example: content="text/html; charset=ISO-8859-1"
        $this->resourceInfo->charset = 'text/html';
        $this->resourceInfo->content = 'charset=UTF-8';

        // document keywords
        $this->resourceInfo->keywords = ['mock'];

        // document description
        $this->resourceInfo->description = 'dome dummy document';
    }

    protected function extractResourceContentFromDom(\simple_html_dom &$dom) {}
}
