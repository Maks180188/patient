<?php

namespace App\Services\Interfaces;

interface PatientServiceInterface
{
    public function createPatient(array $data);
    public function updatePatient(): array;
    public function getPatient(): array;
    public function getPatientList(): array;
    public function deletePatient(): array;

}
