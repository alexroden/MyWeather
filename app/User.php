<?php

namespace App;

use App\Util\Environment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

/**
 * @property string id
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 */
class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'string',
        'first_name' => 'string',
        'last_name'  => 'string',
        'email'      => 'string',
        'city'       => 'string',
    ];

    /**
     * Override the boot method on the model so we can auto generate things.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        /*
         * Runs whenever the model is being created.
         *
         * @param App/User $user
         */
        self::creating(function (User $user) {
            $user->id = !Environment::isTest() ?
                (string) Uuid::uuid4() :
                '0000-0000-0000-0000';
        });
    }

    /**
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }
}
