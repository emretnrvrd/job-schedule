<?php

namespace App\JobProvider\Request;

use Illuminate\Http\Client\Response;
use App\JobProvider\Request\RequestInterface;

abstract class RequestAbstract implements RequestInterface {

    protected Response $response;
    protected string $url;
    protected array $options;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }


}
