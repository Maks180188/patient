<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewPatientRequest;
use App\Services\Interfaces\PatientServiceInterface;

class PatientController extends Controller
{
    public function __construct(
        private readonly PatientServiceInterface $patientService
    )
    {
    }

    public function addNewPatient(AddNewPatientRequest $request)
    {
        return $this->patientService->createPatient($request->validated());
    }

    public function getPatients(): array
    {
        return $this->patientService->getPatientList();
    }
}
