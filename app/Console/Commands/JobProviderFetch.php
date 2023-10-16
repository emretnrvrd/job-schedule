<?php

namespace App\Console\Commands;

use App\JobProvider\Facade\JobProvider;
use App\Models\Job;
use Illuminate\Console\Command;

class JobProviderFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job-provider:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all jobs with job provider and save database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jobProvider = JobProvider::getInstance();
        $jobs = $jobProvider->getAllJobs();

        $this->info($jobs->count(). " jobs found!");
        $this->newLine(1);

        $this->info("Jobs saving to db...");


        $progressbar = $this->output->createProgressBar($jobs->count());
        $progressbar->start();

        $jobs->each(function($job) use ($progressbar) {
            Job::updateOrCreate([ "remote_id" => $job["id"] ],
                [
                    "level" => $job["level"],
                    "duration" => $job["duration"]
                ]
            );
            $progressbar->advance();
        });

        $progressbar->finish();

        $this->newLine(2);

        $this->info("All jobs saved to db successfuly!");
    }
}
