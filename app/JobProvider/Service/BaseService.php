<?php

namespace App\JobProvider\Service;

use App\JobProvider\Mapper\MapperInterface;
use App\JobProvider\Request\RequestInterface;
use App\JobProvider\Service\ServiceInterface;


class BaseService extends ServiceAbstract {
    use ServiceFactory;
}
