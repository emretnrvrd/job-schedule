<?php

namespace App\JobProvider\Service;

use App\JobProvider\Mapper\MapperInterface;
use App\JobProvider\Request\RequestInterface;
use Illuminate\Support\Collection;

interface ServiceInterface {

    public function getUrl(): string;

    public function getTitle(): string;

    public function getRequest(): RequestInterface;

    public function getMapper(): MapperInterface;

    public function prepareRequest(): void;

    public function sendRequest(): void;

    public function mapResponse(): Collection;

}
