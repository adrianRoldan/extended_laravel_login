<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $password
 * @property array $emails
 * @property ?string $avatar
 * @property ?string $google_id
 * @method where(string $string, string $value)
 * @method create(array $toArray)
 */
final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'avatar',
        'google_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Accesor get para mostrar un avatar por defecto
     * @return mixed|string
     */
    public function getAvatarAttribute(): mixed
    {
        if(!$this->attributes['avatar'])
            return asset("img/default_avatar.png");

        return $this->attributes['avatar'];
    }

    /**
     * Relacion con los emails del usuario
     * @return HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(UserEmailAlias::class);
    }


    /**
     * @return UserFactory
     */
    protected static function newFactory(): UserFactory {
        return UserFactory::new();
    }
}
