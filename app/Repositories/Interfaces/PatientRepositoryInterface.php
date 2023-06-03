<?php

namespace App\Repositories\Interfaces;

interface PatientRepositoryInterface
{
    public function createPatient(array $data);

    public function getAllPatients(): array;
}
