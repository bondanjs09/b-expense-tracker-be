<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database
     */
    protected $table = 'bet_user_tbl';

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * Auto increment karena BIGINT
     */
    public $incrementing = true;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Karena kita memakai createdAt & updatedAt (custom)
     */
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'isActive',
        'createdAt',
        'updatedAt',
    ];

    /**
     * Kolom yang disembunyikan saat serialize
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'isActive'  => 'boolean',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];

    /**
     * Otomatis hash password saat diset
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
