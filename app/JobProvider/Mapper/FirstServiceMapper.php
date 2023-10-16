<?php

namespace App\JobProvider\Mapper;

use App\JobProvider\Mapper\MapperAbstract;

class FirstServiceMapper extends MapperAbstract {

    public function map($data) {
        return [
            "id" => $data["id"] ?? null,
            "level" => $data["zorluk"] ?? null,
            "duration" => $data["sure"] ?? null,
        ];
    }

}
