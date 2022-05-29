<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository extends GlobalRepository implements PackageRepositoryInterface
{
    public function __construct(Package $model)
    {
        parent::__construct($model);
    }

}
