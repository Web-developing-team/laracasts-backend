<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use App\Traits\PermissionTrait;

class Role extends Model
{
    use HasFactory, ModelTrait, PermissionTrait;

    protected $fillable = [ 'name' ];

}
