<?php

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Inmanturbo\B2bSaas\SqliteTeamDatabase;

it('creates and deletes an sqlite database', function () {
    $user = User::factory()->create();

    $database = SqliteTeamDatabase::create([
        'user_id' => $user->id,
        'name' => 'test',
    ]);

    $this->assertFileExists(Storage::disk('local')->path($user->uuid.'/'.$database->name.'.sqlite'));

    $database->delete();

    $this->assertFileDoesNotExist(Storage::disk('local')->path($user->uuid.'/'.$database->name.'.sqlite'));
});
