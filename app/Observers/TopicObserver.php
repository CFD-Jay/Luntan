<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }
    
    //数据库入库前（存入topic）
    public function saving(Topic $topic)
    {
        //通过purifier过滤XXS。在配置文件config/purifier.php
        //注意注意 开了Simditor该过滤失效
         $topic->body = clean($topic->body, 'user_topic_body');
        
        //make_excerpt是定义在helpers的函数，根据topic的body生成excerpt.
        $topic->excerpt=make_excerpt($topic->body);
        
        
        //如果slug为空，则使用百度翻译接口翻译
         if ( ! $topic->slug) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
    
}