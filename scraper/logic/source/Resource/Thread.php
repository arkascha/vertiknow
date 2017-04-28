<?php

namespace VertiKnow\Scraper;

abstract class Resource_Thread
    extends Resource_Entity {

    const RESOURCE_URL = NULL;

    /**
     * var string
     */
    protected $resourceUrl;

    /**
     * var simple_dom_element
     */
    protected $resourceDom = NULL;
    /**
     * var array
     */
    protected $resourcePosts = [];
    /**
     * var Resource_Info
     */
    protected $resourceInfo = NULL;

    public function __construct(int $resourceUrl, Worker_Fetcher_EntityFactory $fetcherFactory) {
        parent::__construct(new Info_Thread, $resourceUrl, $fetcherFactory);
    }

    /**
     * @returns string
     */
    static public function getResourceUrl(int $threadId): string {
        return sprintf(static::RESOURCE_URL, $threadId);
    }

    /**
     * @returns int
     */
    static public function getFetcherType(): int {
        return static::FETCHER_TYPE;
    }

    /**
     * @returns int
     */
    abstract public function getMinPostId(): int;
    /**
     * @returns int
     */
    abstract public function getMaxPostId(): int;

    abstract protected function extractResourceInfoFromDom(\simple_html_dom &$dom);
    abstract protected function extractResourcePostFromDom(\simple_html_dom &$dom);

    public function __construct(Resource_Page $threadUrl, Worker_Fetcher_Factory $fetcherFactory) {
        $this->threadUrl = $threadUrl;
        $this->resourceInfo = new Info_Thread;
    }

    public function scrape() {
        try {
            $fetcherWorker = $this->getFetcherWorker();
            $this->resourceContent = $fetcherWorker->fetchContent($this->getThreadUrl);
            $this->processResourceContent($resourceContent);
        } catch (VertiknowException $e) {
            error_log("failed to process thread content");
            throw $e;
        }
    }

    public function getResourceInfo() {
        return $this->resourceInfo;
    }

    protected function processResourceContent(string $resourceContent) {
        $dom = new \simple_html_dom();
        $dom->load($resourceContent);
        $this->extractResourceInfoFromDom($dom);
        $this->extractResourcePostFromDom($dom);
    }
}
