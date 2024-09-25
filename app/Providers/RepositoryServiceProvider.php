<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\Departments\DepartmentRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Drivers\DriverRepositoryInterface;
use App\Interfaces\Groups\GroupRepositoryInterface;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Interfaces\Laps\LapRepositoryInterface;
use App\Interfaces\Medicines\MedicineRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\Pharmacies\PharmacyRepositoryInterface;
use App\Interfaces\Pharmacists\PharmacistRepositoryInterface;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Interfaces\Tests\TestRepositoryInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\Departments\DepartmentRepository;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Drivers\DriverRepository;
use App\Repository\Groups\GroupRepository;
use App\Repository\Insurances\InsuranceRepository;
use App\Repository\Laps\LapRepository;
use App\Repository\Medicines\MedicineRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\Pharmacies\PharmacyRepository;
use App\Repository\Pharmacists\PharmacistRepository;
use App\Repository\Services\ServiceRepository;
use App\Repository\Tests\TestRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(DriverRepositoryInterface::class, DriverRepository::class);
        $this->app->bind(PharmacyRepositoryInterface::class, PharmacyRepository::class);
        $this->app->bind(PharmacistRepositoryInterface::class, PharmacistRepository::class);
        $this->app->bind(LapRepositoryInterface::class, LapRepository::class);
        $this->app->bind(MedicineRepositoryInterface::class, MedicineRepository::class);
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
