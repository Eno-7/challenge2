<?php

namespace App\Jobs;

use App\Models\Company;
use App\Services\CompanyPaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompanyPackageRenewalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Company $company;
    public int $tries = 3;
    private int|float $retry = 3600 * 24;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new CompanyPaymentService();
        $getPayment = $service->getPayment($this->company);

        if(!$getPayment){
            if($this->attempts() >= 3){
                $this->company->status = false;
                $this->company->save();
            } else {
                $this->release($this->retry);
            }
        }
    }
}
