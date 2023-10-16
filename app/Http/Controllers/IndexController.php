<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Job;
use App\Scheduler\DevWeeklySchedule;
use App\Scheduler\ScheduledJob;
use App\Scheduler\Scheduler;

class IndexController extends Controller
{
    public function index(){


        $developers = Developer::all();
        $jobs = Job::all();

        $schedule = new Scheduler($jobs, $developers);


        $weeklyWorkForce = $developers->reduce(fn($total, $dev) => $total + $dev->workforce_per_week, 0);
        $totalRequiredEffort = $jobs->reduce(fn($total, $job) => $total + $job->required_effort, 0);

        $weekDuration = number_format($totalRequiredEffort/$weeklyWorkForce, 2);
        $dayDuration = number_format($totalRequiredEffort/$weeklyWorkForce * 5, 2);
        return view("home", [
            "week_duration" => $weekDuration,
            "day_duration" => $dayDuration,
            "schedule" => $schedule->get(),
        ]);

    }
}
