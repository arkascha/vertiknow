<?php

namespace VertiKnow\Scraper;

class Resource_Schachburg_Thread
    extends Resource_Thread {
    use ResourceWithUrlIdentifiedById;

    const THREAD_URL = 'https://www.schachburg.de/threads/%d';
    const FETCHER_TYPE = Worker_Fetcher_PageType::CURL;

    public function getMinThreadId(): int {
        return min(array_keys($this->resourcePosts));
    };

    public function getMaxThreadId(): int {
        return self::MAX_THREAD_ID;
    };

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

    protected function extractResourcePostFromDom(\simple_html_dom &$dom) {
        $containers = $dom->find('body li.postcontainer');
        foreach ($containers as $container) {
            // create new post in thread
            $this->resourcePosts[] = new Resource_Schachburg_Post($container);
        }
    }
}
