<?php

namespace App\Observers;

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
        // $reply->topic->increment('reply_count', 1);
        // 上面自增 1 是比较直接的做法，另一个比较严谨的做法是创建成功后计算本话题下评论总数，然后在对其
        // reply_count 字段进行赋值。
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();

    }


}
