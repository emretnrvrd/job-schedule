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
        return view("home", ["schedule" => $schedule->get()]);

    }
}
