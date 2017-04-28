<?php

namespace VertiKnow\Scraper;

class Worker_Fetcher_Mock
    extends Worker_Fetcher_Entity {

    public function fetchContent(string $url): string {
        return <<<html
<html>
<head>
  <title>Some dummy document</title>
</head>
<body>
  <h1>Some dummy document</h1>
</body>
</html>
HTML;

    }
}
