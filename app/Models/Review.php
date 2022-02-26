<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table='reviews';
    protected $fillable=[
        'prod_id',
        'user_id',
        'review'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
