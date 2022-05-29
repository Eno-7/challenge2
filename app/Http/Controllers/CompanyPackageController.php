<?php

namespace App\Http\Controllers;


use App\Http\Requests\SetCompanyPackageRequest;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\PackageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;


/**
 * @property CompanyRepositoryInterface $companyRepository
 * @property PackageRepositoryInterface $packageRepository
 */
class CompanyPackageController extends Controller
{
    /**
     * @param CompanyRepositoryInterface $companyRepository
     * @param PackageRepositoryInterface $packageRepository
     */
    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        PackageRepositoryInterface $packageRepository
    ){
        $this->companyRepository = $companyRepository;
        $this->packageRepository = $packageRepository;
    }

    /**
     * @param SetCompanyPackageRequest $request
     * @return JsonResponse
     */
    public function setCompanyPackage(SetCompanyPackageRequest $request): JsonResponse
    {
        $setCompanyData = $request->validated();
        $package = $this->packageRepository->find($setCompanyData['package_id']);
        $company = $this->companyRepository->find($setCompanyData['company_id']);

        $startDate = Carbon::now();
        $endDate = $package->type == 'yearly' ? now()->addYears($package->period) : now()->addMonths($package->period);
        $company->package()->attach($package->id, [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => true
        ]);

        return response()->json([
            'status' => true,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'package' => $package
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getCompanyPackage(): JsonResponse
    {
        $getCompanyPackage = auth()->user()->load('company','company.package');

        return response()->json($getCompanyPackage);
    }
}
