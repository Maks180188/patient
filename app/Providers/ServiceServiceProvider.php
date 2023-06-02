<?php

namespace App\Providers;

use App\Providers\Helpers\RegistrationHelper;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\PatientRepository;
use App\Services\Interfaces\PatientServiceInterface;
use App\Services\PatientService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    use RegistrationHelper;

    private array $bindServices = [
        PatientServiceInterface::class => PatientService::class,
        PatientRepositoryInterface::class => PatientRepository::class,
    ];
}
