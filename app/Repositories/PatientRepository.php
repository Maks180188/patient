<?php

namespace App\Repositories;

use App\Jobs\ProcessCreatePatient;
use App\Models\Patient;

class PatientRepository implements Interfaces\PatientRepositoryInterface
{

    public function createPatient(array $data): void
    {
        ProcessCreatePatient::dispatch($data);
    }
}
