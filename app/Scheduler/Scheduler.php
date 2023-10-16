<?php

namespace App\Scheduler;

use App\Models\Developer;
use App\Models\Job;
use Illuminate\Support\Collection;

class Scheduler {
    private Collection $scheduledJobs;

    public function __construct(private Collection $jobs, private Collection $developers) {
        $this->scheduledJobs =  $this->jobs->map(fn($job) => new ScheduledJob($job));
    }

    private function getWorkableJobs() {
        return $this->scheduledJobs->filter(
            fn(ScheduledJob $scheduleJob) => $scheduleJob->getRemainingEffort() > 0
        );
    }

    private function hasWorkableJobs() {
        return $this->getWorkableJobs()->count() > 0;
    }

    public function get() {
        $schedule = collect();
        while($this->hasWorkableJobs()) {
            $schedule->push($this->createDailyScheduleForDevelopers());
        }
        return $schedule;
    }

    private function createDailyScheduleForDevelopers(){
        $dailySchedules = $this->developers
            ->sortByDesc("workforce_per_hour")
            ->map(fn($developer) => new DevDailySchedule($developer));

        while($this->hasRemainingEffortFromDailySchedules($dailySchedules) && $this->hasWorkableJobs()) {

            foreach($dailySchedules as $dailySchedule) {
                if(!$this->scheduleJobToDeveloper($dailySchedule)) {
                    break;
                }
            }
        }

        return $dailySchedules;
    }

    private function hasRemainingEffortFromDailySchedules ($dailySchedules): bool
    {
        return $dailySchedules->contains(fn($dailySchedule) => $dailySchedule->getRemainingEffort() > 0);
    }

    private function scheduleJobToDeveloper($dailySchedule) {
        if($dailySchedule->getRemainingEffort() == 0) {
            return true;
        }
        $maxEffortJob = $this->getWorkableJobs()->sortByDesc(fn(ScheduledJob $scheduleJob) => $scheduleJob->getRemainingEffort())->first();
        if(!$maxEffortJob) {
            return false;
        }
        $maxEffortJobRemainingEffort = $maxEffortJob->getRemainingEffort();
        $devWeeklyScheduleRemainingEffort = $dailySchedule->getRemainingEffort();

        $workingEffort = $maxEffortJobRemainingEffort >= $devWeeklyScheduleRemainingEffort
            ? $devWeeklyScheduleRemainingEffort
            : $maxEffortJobRemainingEffort;

        $maxEffortJob->addScheduled($dailySchedule->getDeveloper(), $workingEffort);
        $dailySchedule->addJob($maxEffortJob->getJob(), $workingEffort);

        return true;
    }


}
