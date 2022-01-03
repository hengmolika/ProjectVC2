<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','gender','class','profile','phone'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
    
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }
}
