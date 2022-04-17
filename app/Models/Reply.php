<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;
    
    //只允许用户修改回复内容
    protected $fillable = ['content'];
    
    //增加模型关系，一个回复对应一个用户，一个回复对应一个话题
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
