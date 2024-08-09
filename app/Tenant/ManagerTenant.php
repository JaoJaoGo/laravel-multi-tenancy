<?php

namespace App\Tenant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;

class ManagerTenant
{
    public function setConnection(Company $company)
    {
        DB::purge('tenant');

        config()->set('database.connections.tenant.database', $company->bd_database);
        config()->set('database.connections.tenant.host', $company->bd_host);
        config()->set('database.connections.tenant.username', $company->bd_username);
        config()->set('database.connections.tenant.password', $company->bd_password);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }
}
