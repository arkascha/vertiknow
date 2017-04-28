<?php

namespace VertiKnow\Scraper;

class Resource_Schachburg_Post
    extends Resource_Post {

    static public function getPostUrl(int $threadId, int $postId): string {
        return NULL;
    }

    protected function extractResourcePostFromContainer(\simple_html_dom_node $domNode) {
        $this->extractResourcePostFromContainerPartHead($domNode->find('div.posthead', 0));
        $this->extractResourcePostFromContainerPartUser($domNode->find('div.postdetails .userinfo', 0));
        $this->extractResourcePostFromContainerPartText($domNode->find('div.postdetails .postbody', 0));
    }

    private function extractResourcePostFromContainerPartHead(\simple_html_dom_node $domNode) {
        $head = $domNode->find('.postdate .date', 0); // e.g. "09.04.2017,&nbsp;20:58
        preg_match("/(\d{2})\.(\d{2})\.(\d{4})/", $head->plaintext, $date);
        preg_match("/(\d{2})\:(\d{2})/", $head->plaintext, $time);
        $this->dateTime = new \DateTime;
        if (count($date)) {
            $this->dateTime->setDate($date[3], $date[2], $date[1]);
        }
        if (count($time)) {
            $this->dateTime->setTime($time[1], $time[2]);
        }
    }

    private function extractResourcePostFromContainerPartUser(\simple_html_dom_node $domNode) {
        $this->userInfo->name = strip_tags($domNode->find('.username_container .username', 0)->plaintext);

        // parse all available attributes
        $keys = $domNode->find('.userinfo_extra dt');
        $vals = array_slice($domNode->find('.userinfo_extra dd'), 1);
        for ($i=0; $i<count($keys); $i++) {
            $this->userInfo->{$keys[$i]->plaintext} = $vals[$i]->plaintext;
        }

        // explicitly set rating
        $this->userRating = $this->userInfo->Punkte;
    }

    private function extractResourcePostFromContainerPartText(\simple_html_dom_node $domNode) {
        $this->postText->id = trim($domNode->find('.postrow .content div[id]', 0)->id);
        $this->postText->title = trim(strip_tags($domNode->find('.postrow .title', 0)->plaintext));
        $this->postText->content = trim(strip_tags($domNode->find('.postrow .content .postcontent', 0)->plaintext));
    }
}
