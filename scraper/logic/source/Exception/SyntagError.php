<?php

namespace VertiKnow\Scraper;

abstract class Exception_VertiknowError extends \Exception {

    const TYPE = NULL;

    protected $type;
    protected $time;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);

        $this->type = static::TYPE;
        $this->time = new \DateTime();
    }

    public function __toString() {
        return
            "VertiKnow exception of type '" . $this->type . "'" . PHP_EOL .
            "Event date time: " . $this->time->format(\DateTime::ISO8601) . PHP_EOL .
            "Event time stamp: " . $this->time->getTimestamp() . PHP_EOL .
            parent::__toString();
    }

}
