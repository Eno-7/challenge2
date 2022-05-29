<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','period','price'];

    public function company()
    {
        return $this->belongsToMany(Company::class, CompanyPackage::class);
    }
}
