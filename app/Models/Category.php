<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



//贴子模型
class Category extends Model
{
    use HasFactory;
    protected $timestamps=false;
    
    protected $fillable=[
        'name',
        'description',
        ];
}
