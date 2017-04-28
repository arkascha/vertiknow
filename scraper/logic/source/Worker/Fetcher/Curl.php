<?php

namespace VertiKnow\Scraper;

class Worker_Fetcher_Curl
    extends Worker_Fetcher_Entity {

    public function fetchContent(string $url): string {

        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curlHandle, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
        $content = curl_exec($curlHandle);
        curl_close($curlHandle);

        if ( ! $content) {
            throw new Exception_VertiknowRuntimeError(
                sprintf("failed to fetch content from url '%s', reason: %s", $url, curl_error($curlHandle))
            );
        }
        return $content;
    }
}
