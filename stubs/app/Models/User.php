<?php

namespace App\Models;

use App\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Inmanturbo\B2bSaas\HasB2bSaas;
use Inmanturbo\B2bSaas\UsesLandlordConnection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $type
 * @property int $id
 * @property int $current_team_id
 * @property \App\Models\Team $currentTeam
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $two_factor_secret
 * @property string $two_factor_recovery_codes
 * @property string $profile_photo_path
 * @property string $remember_token
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \App\Models\Team[] $allTeams
 * @property \App\Models\Team[] $ownedTeams
 * @property \App\Models\Team[] $teams
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasB2bSaas;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use UsesLandlordConnection;
    use WithUuid;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasPermissionTo($permission)
    {
        return $this->hasTeamRole($this->currentTeam, 'admin');
    }

    public function canImpersonate()
    {
        return Gate::forUser($this)->allows('impersonateAny');
    }

    public function canBeImpersonated($impersonater)
    {
        return Gate::forUser($impersonater)->allows('impersonate', $this);
    }

    public function isImpersonated()
    {
        return session()->has('impersonate') && session('impersonate') === $this->id;
    }
}
