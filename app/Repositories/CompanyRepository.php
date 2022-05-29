<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository extends GlobalRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}
