<?php

namespace App\Services;


use App\Jobs\CompanyPackageRenewalJob;
use App\Models\Company;
use App\Models\CompanyPayments;


class CompanyPaymentService
{
    public function paymentQueue()
    {
        $companies = Company::where('status', true)->whereHas('package', function ($q){
            $q->whereDate('end_date', '<=', now());
        })->with('package')->get();

        foreach ($companies as $company) {
           CompanyPackageRenewalJob::dispatch($company);
       }
    }

    /**
     * @param Company $company
     * @return bool
     */
    public function getPayment(Company $company): bool
    {
        $hash = rand(100000, 1000000);
        $status = !($hash % 2 == 0);
        $package = $company->package[0];

        $companyPayment = new CompanyPayments();
        $companyPayment->company_package_id = $package->id;
        $companyPayment->hash = $hash;
        $companyPayment->price = $package->price;
        $companyPayment->status = $status;
        $companyPayment->save();

        if($status){
            $endDate = $package->type == 'yearly' ?
                now()->addYears($package->period) : now()->addMonths($package->period);
            $company->package[0]->pivot->end_date = $endDate;
            $company->package[0]->pivot->save();
        }

        return $status;
    }
}
