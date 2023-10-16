<?php

namespace App\JobProvider\Provider;

use App\JobProvider\Service\ServiceInterface;

trait ProviderFactory {

    public static function create(ServiceInterface $service){
        return new BaseProvider($service);
    }

    public static function createMany(array $services){
        return array_map(fn($item) => self::create($item), $services);
    }

}
