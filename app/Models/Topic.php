<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body',  'category_id',  'excerpt', 'slug'];
    
    
    
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
    
    
    
    
    
    
    public function  scopeWithOrder($query,$order)
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
    
     public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
    
    
    
    
    
    //获取帖子的slug，并将其显示在url上
    //修改topic.show Eg：return redirect()->route('topics.show', $topic->id)->with('success', '成功创建话题！');==>return redirect()->to($topic->link())->with('success', '成功创建话题！');
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
    
    
    
    
}
