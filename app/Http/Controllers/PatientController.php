<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewPatientRequest;
use App\Models\Patient;
use App\Services\Interfaces\PatientServiceInterface;

class PatientController extends Controller
{
    public function __construct(
        private readonly PatientServiceInterface $patientService
    )
    {
    }

    public function addNewPatient(AddNewPatientRequest $request): Patient
    {
        return $this->patientService->createPatient($request->validated());
    }
}
