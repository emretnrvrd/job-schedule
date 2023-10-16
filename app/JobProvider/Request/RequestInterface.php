<?php

namespace App\JobProvider\Request;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

interface RequestInterface {

    public function getUrl(): string;

    public function setUrl(string $url): void;

    public function getOptions(): array;

    public function setOptions(array $options): void;

    public function getResponse(): Response;

    public function sendRequest(): void;

    public function parseResponse(): Collection;

    public function getParsedResponse(): Collection;
}
