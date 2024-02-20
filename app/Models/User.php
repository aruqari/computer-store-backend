<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Model implements Authenticatable
{
    protected $table = "users";
    protected $primaryKey = "id_user";
    protected $keyType = "string";
    public $timestamps = true;
    protected $fillable = ["id_user", "id_pelanggan", "role", "username", "password"];

    public function getAuthIdentifierName()
    {
        return "username";
    }

    
    public function getAuthIdentifier()
    {
        return $this->username;
    }

    
    public function getAuthPassword()
    {
        return $this->password;
    }

    
    public function getRememberToken()
    {
        return $this->token;
    }

    
    public function setRememberToken($value)
    {
        return $this->password = $value;
    }

    public function getRememberTokenName()
    {
        return "token";
    }
}
