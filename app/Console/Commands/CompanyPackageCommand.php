<?php

namespace App\Console\Commands;

use App\Repositories\CompanyRepositoryInterface;
use App\Services\CompanyPaymentService;
use Illuminate\Console\Command;

class CompanyPackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new CompanyPaymentService();
        $service->paymentQueue();
        return 0;
    }
}
