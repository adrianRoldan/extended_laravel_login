<?php

namespace App\Models;

use Database\Factories\UserEmailAliasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmailAlias extends Model
{
    use HasFactory;


    protected $fillable = [
        'email',
        'primary',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return UserEmailAliasFactory
     */
    protected static function newFactory(): UserEmailAliasFactory {
        return UserEmailAliasFactory::new();
    }

}
