<?php

namespace VertiKnow\Scraper;

abstract class Resource_Forum
    extends Resource_Entity {

    use Feature_HasChildren, Feature_HasUrl;

    /**
     * var simple_html_dom_element
     */
    protected $resourceDom = NULL;

    /**
     * var array
     */
    protected $resourceThreads = [];

    /**
     * var Resource_Info
     */
    protected $resourceInfo = NULL;

    public function __construct(string $resourceUrl, Worker_Fetcher_EntityFactory $fetcherFactory) {
        parent::__construct(new Info_Forum, $fetcherFactory);
        $this->initFeature_HasChildren();
        $this->initFeature_HasUrl($resourceUrl, $fetcherFactory);
    }

    /**
     * @returns string
     */
    static public function getResourceUrl(int $forumId): string {
        return sprintf(static::RESOURCE_URL, $forumId);
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

    public function process() {
        try {
            $resourceContent = $this->fetchResourceContent()
            $this->processResourceContent($resourceContent);
        } catch (VertiknowException $e) {
            error_log("failed to process forum content");
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
