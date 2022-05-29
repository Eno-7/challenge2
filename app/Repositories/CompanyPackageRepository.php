<?php

namespace App\Repositories;

use App\Models\CompanyPackage;

class CompanyPackageRepository extends GlobalRepository implements CompanyPackageRepositoryInterface
{
    public function __construct(CompanyPackage $model)
    {
        parent::__construct($model);
    }
}
