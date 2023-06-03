<?php

namespace App\Http\Formaters;

class PatientFormatter
{
    public function single(array $data): array
    {
        return [
            'id' => $data['id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'age' => $data['age'],
            'age_type' => $data['age_type'],
        ];
    }

    public function multi(array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = $this->single($item);
        }

        return $result;
    }

}
