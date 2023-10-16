<?php

namespace App\JobProvider\Service;


trait ServiceFactory {

    public static function create(string $url, string $title, string $requestClassName, string $mapperClassName): ServiceInterface{
        return new BaseService($url, $title, new $requestClassName, new $mapperClassName);
    }

    public static function createMany(array $data): array
    {
        return array_map(fn($item) => self::create($item["url"], $item["title"], $item["request"], $item["mapper"]), $data);
    }
}
