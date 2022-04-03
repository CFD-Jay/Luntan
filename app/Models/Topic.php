<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
    
    
    
    //创建模型关系
    //一个帖子属于一个话题
    //一个帖子属于一个用户
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    
    
    
    
    
    public function   scopeWithOrder($query,$order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            
            default:
               $query->recentReplied();
                break;
        }
        
    }
    
    public function scoperecent($query)
    {
        return $query->orderBy('created_at','desc');
    }
     public function scoperecentReplied($query)
    {
        return $query->orderBy('updated_at','desc');
    }
    
    
}
