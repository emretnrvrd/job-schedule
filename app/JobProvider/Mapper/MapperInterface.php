<?php

namespace App\JobProvider\Mapper;

use Illuminate\Support\Collection;

interface MapperInterface {

    public function map($data);

    public function collectionMap(Collection $collection): Collection;

}
