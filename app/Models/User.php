<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'user_uuid';
    protected $fillable = [
        'user_uuid',
        'user_name',
        'user_username',
        'user_phonenumber',
        'user_email',
        'user_password',
        'user_isadmin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_password' => 'hashed',
        'user_uuid' => 'string',
    ];

    public function transaction () {
        return $this->hasMany(TransactionModel::class, 'user_id', 'user_id');
    }

    public static function getAdmins()
    {
        $data = self::where('user_isAdmin', true)->get();
        
        return $data;
    }

    public static function getCustomers()
    {
        $data = self::where('user_isAdmin', false)->get();
        
        return $data;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_uuid = (string) Str::uuid();
        });
    }
}
