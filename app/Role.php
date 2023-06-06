<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = "roles";
    protected $fillable = [
        'name', 'description',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class , 'role_permission');
    }
}
