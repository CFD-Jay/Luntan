<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use App\Models\Topic;
class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Reply $reply)
    {
        //回复的删除权限是，1.只能删除自己发的回复 2.up可以删除任何人回复，即发帖子人id==当前登录人
        return ($user->id==$reply->user_id||$user->id==$reply->topic->user_id);
    }
}
