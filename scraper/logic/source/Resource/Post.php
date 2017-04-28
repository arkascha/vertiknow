<?php

namespace VertiKnow\Scraper;

abstract class Resource_Post
    extends Resource_Entity {

    protected $dateTime;
    /**
     * var Info_Post
     */
    protected $resourceInfo;

    abstract protected function extractResourcePostFromContainer(\simple_html_dom_node $domNode);

    public function __construct(\simple_html_dom_node $domNode) {
        $this->userInfo = new Info_User;
        parent::__construct(new Info_Post, new Worker_Fetcher_EntityFactory);
        $this->extractResourcePostFromContainer($domNode);
    }
}
