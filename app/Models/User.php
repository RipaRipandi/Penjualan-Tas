<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    // Relasi: 1 user punya banyak transaksi
    public function trans()
    {
        return $this->hasMany(Transaction::class, 'id_user', 'id_user');
    }
}