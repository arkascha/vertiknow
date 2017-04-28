<?php

namespace VertiKnow\Scraper;

abstract class Info_Entity {

    protected $attributes = [];

    public function listAttributes() {
        return $this->attributes;
    }

    public function listAttributeKeys() {
        return array_keys($this->attributes);
    }

    public function __get(string $attribute) {
        return isset($this->attributes[$attribute]) ? $this->attributes[$attribute] : NULL;
    }

    public function __set(string $attribute, $value) {
        return $this->attributes[$attribute] = $value;
    }

    public function __isset($attribute): boolean {
        return isset($this->attributes[$attribute]);
    }

    public function __unset($attribute) {
        unset($this->attributes[$attribute]);
    }
}
