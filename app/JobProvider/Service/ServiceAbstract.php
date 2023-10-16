<?php

namespace App\JobProvider\Service;

use App\JobProvider\Mapper\MapperInterface;
use App\JobProvider\Request\RequestInterface;
use App\JobProvider\Service\ServiceInterface;
use Illuminate\Support\Collection;

abstract class ServiceAbstract implements ServiceInterface {

    public function __construct(
        protected string $url,
        protected string $title,
        protected RequestInterface $request,
        protected MapperInterface $mapper,
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getMapper(): MapperInterface
    {
        return $this->mapper;
    }

    public function prepareRequest(): void
    {
        $this->request->setUrl($this->url);
        $this->request->setOptions([]);
    }

    public function sendRequest(): void
    {
        $this->request->sendRequest();
    }

    public function mapResponse(): Collection
    {
        return $this
            ->getMapper()
            ->collectionMap(
                $this->getRequest()->getParsedResponse()
            );
    }

}
