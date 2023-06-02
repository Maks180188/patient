<?php

namespace App\Services\Interfaces;

use App\Models\Patient;

interface PatientServiceInterface
{
    public function createPatient(array $data): Patient;
    public function updatePatient(): array;
    public function getPatient(): array;
    public function getPatientList(): array;
    public function deletePatient(): array;

}
