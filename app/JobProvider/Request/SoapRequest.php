<?php

namespace App\JobProvider\Request;
use Illuminate\Support\Collection;

class SoapRequest extends RequestAbstract {

    public function sendRequest(): Response
    {
        //....
    }

    public function parseResponse(Response $response): Collection
    {
        //....
    }

    public function getParsedResponse(): Collection
    {
        //....
    }

}
