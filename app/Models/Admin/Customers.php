<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
  
    protected $dates = [
        'created_at',
        'updated_at',
        
    ];
    protected $fillable = [
        'name', 'slug', 'phone','address','bonus_points','user_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'customers';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo(Users::class,'user_id','id');
    }
}
