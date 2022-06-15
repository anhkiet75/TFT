<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $primaryKey = 'serial_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function users() {
        return $this->hasMany(User::class,'user_id');
    }

    public function categories() {
        return $this->hasMany(Category::class,'user_id');
    }

}
