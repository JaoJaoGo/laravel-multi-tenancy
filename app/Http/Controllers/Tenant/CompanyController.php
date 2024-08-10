<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function store(Request $request)
    {
        $company = $this->company->create([
            'name'          => "Empresa X" . Str::random(5),
            'domain'        => Str::random(5) . 'minhaempresa.com',
            'bd_database'   => 'multi_tenant' . Str::random(5),
            'bd_host'       => 'db',
            'bd_username'   => 'root',
            'bd_password'   => 'root',
        ]);

        event(new CompanyCreated($company));

        dd($company);
    }
}
