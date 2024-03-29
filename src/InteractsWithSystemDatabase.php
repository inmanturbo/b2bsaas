<?php

namespace Inmanturbo\B2bSaas;

use Illuminate\Support\Facades\DB;

trait InteractsWithSystemDatabase
{
    use ConfiguresTenantDatabase;

    protected function getSystemDatabaseConnectionName(): string
    {
        return 'mysql';
    }

    protected function deleteTeamDatabase()
    {
        $this->prepareTenantConnection($this->getSystemDatabaseConnectionName());

        $name = (string) str()->of($this->name)->slug('_');

        DB::statement('DROP DATABASE IF EXISTS tenant_'.$name);

        $this->restoreOriginalConnection();
    }

    protected function createTeamDatabase(): self
    {
        $name = (string) str()->of($this->name)->slug('_');

        if ($this->teamDatabaseExists()) {
            $name = $name.'_1';
            $this->name = $name;
            $this->createTeamDatabase();
        }

        if (! app()->runningUnitTests() && config('b2bsaas.features.create_team_databases')){
            DB::connection($this->getSystemDatabaseConnectionName())->statement('CREATE DATABASE IF NOT EXISTS tenant_'.$name);
        }

        return $this;
    }

    protected function teamDatabaseExists(): bool
    {
        $this->prepareTenantConnection($this->getSystemDatabaseConnectionName());

        if (app()->runningUnitTests()){
            $this->restoreOriginalConnection();

            return false;
        }

        $exists = DB::connection($this->getSystemDatabaseConnectionName())->select(
            "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tenant_".$this->name."'"
        );

        $this->restoreOriginalConnection();

        return count($exists) > 0;
    }
}
