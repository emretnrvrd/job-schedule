<?php

namespace App\JobProvider\Provider;

use App\JobProvider\Service\ServiceInterface;

class BaseProvider implements ProviderInterface {

    use ProviderFactory;

    public function __construct(public ServiceInterface $service) {}

    public function get(){
        $this->service->prepareRequest();
        $this->service->sendRequest();
        return $this->service->mapResponse();
    }

}
