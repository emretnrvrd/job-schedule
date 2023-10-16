<?php

namespace App\Scheduler;

use App\Models\Developer;
use App\Models\Job;
use Illuminate\Support\Collection;

class ScheduledJob {
    private Collection $list;

    public function __construct(private Job $job) {
        $this->list = collect([]);
    }

    public function getJob(): Job
    {
        return $this->job;
    }

    public function getList()
    {
        return $this->list;
    }

    public function addScheduled(Developer $developer, int $effort): void
    {
        $this->list->push([
            "developer" => $developer,
            "effort" => $effort
        ]);
    }

    public function getRemainingEffort(): int
    {
        return $this->job->required_effort - $this->list->map(fn($item) => $item["effort"])->sum();
    }

}
