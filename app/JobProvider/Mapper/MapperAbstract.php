<?php

namespace App\JobProvider\Mapper;

use App\JobProvider\Mapper\MapperInterface as MapperMapperInterface;
use Illuminate\Support\Collection;

class MapperAbstract implements MapperMapperInterface {

    public function map($data) {
        return $data;
    }

    public function collectionMap(Collection $collection): Collection
    {
       return $collection->map(fn($item) => $this->map($item));
    }

}
