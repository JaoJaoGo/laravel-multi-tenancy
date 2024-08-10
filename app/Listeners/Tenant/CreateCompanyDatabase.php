<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Tenant\Database\DatabaseManager;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCompanyDatabase
{
    private $database;

    /**
     * Create the event listener.
     */
    public function __construct(DatabaseManager $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        $company = $event->company();

        if(!$this->database->createDatabase($company)) {
            throw new Exception('Ocorreu um erro ao adicionar as tabelas no Banco de Dados!');
        }

        // run migrations
        event(new DatabaseCreated($company));
    }
}
