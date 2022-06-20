<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'  
    ];
}
