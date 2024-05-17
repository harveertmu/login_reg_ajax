<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    use HasFactory;

    protected $table = 'users_access';
    protected $fillable = ['user_id'];

    public function users(){
        return $this->hasMany(User::class,'id','user_id');
    }

}
