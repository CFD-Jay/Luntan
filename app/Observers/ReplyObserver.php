<?php

namespace App\Observers;
use App\Notifications\TopicReplied; //引用通知类
use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function updating(Reply $reply)
    {
        //
    }
    public function created(Reply $reply)
    {
        $reply->topic->reply_count=$reply->topic->replies->count();
        $reply->topic->save();
        
        
        $reply->topic->user->notify(new TopicReplied($reply));
    }
    public function deleted(Reply $reply)
    {
        $reply->topic->reply_count=$reply->topic->replies->count();
        $reply->topic->save();
        
        
        $reply->topic->user->notify(new TopicReplied($reply));
    }
}