<?php

namespace App\Repositories\Interfaces;

use App\Models\Patient;

interface PatientRepositoryInterface
{
    public function createPatient(array $data): Patient;

}
