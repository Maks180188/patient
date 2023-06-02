<?php

namespace App\Repositories;

use App\Models\Patient;

class PatientRepository implements Interfaces\PatientRepositoryInterface
{

    public function createPatient(array $data): Patient
    {
        return Patient::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'age' => $data['ageValue'],
            'age_type' => $data['ageType'],
            'date' => $data['date'],
        ]);
    }
}
