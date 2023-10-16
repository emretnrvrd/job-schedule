<?php

namespace App\JobProvider\Facade;

use App\JobProvider\Provider\BaseProvider;
use App\JobProvider\Provider\ProviderInterface;
use App\JobProvider\Service\BaseService;
use Illuminate\Support\Collection;

class JobProvider {

    private static ?JobProvider $instance;

    private function __construct() {}

    public static function getInstance (): JobProvider{

        return self::$instance ?? new self();
    }


    public function getAllJobs(): Collection {
        $jobProviderData = $this->getJobProviderData();
        $services = BaseService::createMany($jobProviderData);
        $providers = BaseProvider::createMany($services);

        $result = collect([]);

        collect($providers)
            ->map(fn(ProviderInterface $provider) => $provider->get())
            ->each(fn($jobs) => $result->push(...$jobs));

        return $result;
    }

    private function getJobProviderData (): array {
        return config('job_providers');
    }
}
