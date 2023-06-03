<?php

namespace App\Services;

use App\Repositories\Interfaces\PatientRepositoryInterface;
use DateTime;

class PatientService implements Interfaces\PatientServiceInterface
{
    public function __construct(
        private readonly PatientRepositoryInterface $patientRepository
    ) {}
    /**
     * @throws \Exception
     */
    public function createPatient(array $data)
    {
        $formattedBirthdayDateFromForm = self::dateFormatting($data['date']);
        $currentDate = date('d-m-Y');
        $days = self::getDifferenceBetweenDatesInDays($formattedBirthdayDateFromForm, $currentDate);
        $ageData = self::convert($days);
        $ageTypeAndValue = self::getAgeTypeAndValue($ageData);

        $data['date'] = $formattedBirthdayDateFromForm;
        $data['ageType'] = $ageTypeAndValue['ageType'];
        $data['ageValue'] = $ageTypeAndValue['ageValue'];

        return $this->patientRepository->createPatient($data);
    }

    public function updatePatient(): array
    {
        // TODO: Implement updatePatient() method.
    }

    public function getPatient(): array
    {
        // TODO: Implement getPatient() method.
    }

    public function getPatientList(): array
    {
        return $this->patientRepository->getAllPatients();
    }

    public function deletePatient(): array
    {
        // TODO: Implement deletePatient() method.
    }

    public static function dateFormatting(string $date): string
    {
        return date("d-m-Y", strtotime($date));
    }

    public static function convert(int $sum): array
    {
        $years = floor($sum / 365);
        $months = floor(($sum - ($years * 365)) / 30.5);
        $days = ($sum - ($years * 365) - ($months * 30.5));
        return ['years' => $years, 'months' => $months, 'days' => $days];
    }

    /**
     * @throws \Exception
     */
    public static function getDifferenceBetweenDatesInDays($formattedBirthdayDateFromForm, $currentDate): int
    {
        $datetime1 = new DateTime($formattedBirthdayDateFromForm);
        $datetime2 = new DateTime($currentDate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        return (int)$days;
    }

    public static function getAgeTypeAndValue(array $ageData): array
    {
        $ageType = null;
        $ageValue = null;
        foreach ($ageData as $key => $value) {
            if ($key == 'years' && $value > 0) {
                $ageType = 'year';
                $ageValue = $value;
                break;
            }
            if ($key == 'months' && $value > 0) {
                $ageType = 'months';
                $ageValue = $value;
                break;
            }
            if ($key == 'days' && $value > 0) {
                $ageType = 'days';
                $ageValue = $value;
                break;
            }
        }

        return [
            'ageType' => $ageType,
            'ageValue' => $ageValue,
        ];
    }

    public static function addNewPatientDataToCache(array $data): void
    {
        cache(['new_patients' => $data], now()->addMinutes(5));
    }
}
