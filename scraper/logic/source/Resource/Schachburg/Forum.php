<?php

namespace VertiKnow\Scraper;

class Resource_Schachburg_Forum
    extends Resource_Forum
    implements Iterator {

    public function __construct(string $resourceUrl, Worker_Fetcher_ForumFactory $fetcherFactory) {
        parent::__construct($resourceUrl, $fetcherFactory);
        $this->setResourceUrl($resourceUrl);
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
        $containers = $dom->find('ol#threads div.threadinfo .threadtitle a.threadtitle');
        foreach ($anchors as $anchor) {
            // create new thread entity
            $this->resourceChildren[] = new Resource_Schachburg_Thread($anchor->href, $this->fetcherFactory);
        }
    }
}
