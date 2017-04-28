<?php

namespace VertiKnow\Scraper;

trait Feature_HasChildren {

    /**
     * var int
     */
    protected $iteratorPosition;

    /**
     * var Resource_Entity
     */
    protected $resourceChildren;

    protected function initFeature_HasChildren() {
        $this->rewind();
    }

    protected function getMinChildId() {
        return 0;
    }

    protected function getMaxChildId() {
        return count($this->resourceChildren)-1;
    }

    public function getChild($childId) {
        return $this->resourceChildren[$childId];
    }

    // === countable interface ===
    public function count(): int {
        return count($this->resourceChildren);
    }

    // === iterator interface ===
    // note: we count backwards: from current into the past
    public function rewind()          { $this->iteratorPosition = $this->getMaxChildId(); }
    public function current(): string { return self::getThreadUrl($this->iteratorPosition); }
    public function key(): int        { return $this->iteratorPosition; }
    public function next()            { --$this->iteratorPosition; }
    public function valid(): bool     { return $this->iteratorPosition >= $this->getMinChildId(); }
}
