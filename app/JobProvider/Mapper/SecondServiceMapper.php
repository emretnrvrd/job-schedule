<?php

namespace App\JobProvider\Mapper;

use App\JobProvider\Mapper\MapperAbstract;

class SecondServiceMapper extends MapperAbstract {

    public function map($data) {
        $values = array_values($data)[0];
        return [
            "id" => array_keys($data)[0] ?? null,
            "level" => $values["level"] ?? null,
            "duration" => $values["estimated_duration"] ?? null,
        ];
    }

}
