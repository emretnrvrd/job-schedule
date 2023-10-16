<?php

namespace App\JobProvider\Request;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class RestRequest extends RequestAbstract {

    public function sendRequest(): void
    {
        $this->response = Http::get($this->getUrl());
    }

    public function parseResponse(): Collection
    {
        $jsonResponse = $this->response->json();
        return collect($jsonResponse);
    }

    public function getParsedResponse(): Collection
    {
        $this->sendRequest();
        return $this->parseResponse();
    }

}
