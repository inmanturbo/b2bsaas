<?php

namespace Inmanturbo\B2bSaas;

use Illuminate\Support\Facades\Storage;

trait ManagesSqliteDatabase
{
    protected function createTeamDatabase(bool $testing = false): self
    {
        $name = (string) str()->of($this->name)->slug('_');

        if ($this->teamDatabaseExists(testing: $testing)) {
            $name = $name.'_1';
            $this->name = $name;
            $this->createTeamDatabase(testing: $testing);
        }

        $userUuid = (string) $this->user->uuid;

        // create storage directory for user if it doesn't exist using storage facade

        if(! Storage::disk('local')->exists($userUuid)) {
            Storage::disk('local')->makeDirectory($userUuid);
        }

        if(! Storage::disk('local')->exists($this->getRelativePath())) {
            Storage::disk('local')->put($this->getRelativePath(), '');
        }

        return $this;
    }

    protected function deleteTeamDatabase()
    {
        if($this->teamDatabaseExists()) {
            Storage::disk('local')->delete($this->getRelativePath());
        }
    }

    protected function teamDatabaseExists(bool $testing = false): bool
    {
        return Storage::disk('local')->exists($this->getRelativePath());
    }

    protected function getTenantConnectionDatabaseName(): string
    {
        return Storage::disk('local')->path($this->getRelativePath());
    }

    public function getRelativePath(): string
    {
        $name = (string) str()->of($this->name)->slug('_');

        $userUuid = (string) $this->user->uuid;

        return $userUuid.'/'.$name.'.sqlite';
    }
}
