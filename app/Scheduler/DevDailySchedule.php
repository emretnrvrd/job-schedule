<?php

namespace App\Scheduler;

use App\Models\Developer;
use App\Models\Job;
use Illuminate\Support\Collection;

class DevDailySchedule {
    private Collection $jobs;

    public function __construct(private Developer $developer) {
        $this->jobs = collect([]);
    }

    public function getDeveloper(): Developer
    {
        return $this->developer;
    }

    public function getJobs()
    {
        return $this->jobs;
    }

    public function addJob(Job $job, int $effort): void
    {
        $this->jobs->push([
            "job" => $job,
            "effort" => $effort
        ]);
    }

    public function getRemainingEffort(): int
    {
        return ($this->developer->workforce_per_day) - $this->jobs->map(fn($item) => $item["effort"])->sum();
    }

}
