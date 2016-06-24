<?php

namespace Bolt;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    public $fillable = [
        'comment', 'video_id',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentedAt()
    {
        return $this->created_at->diffForHumans();
    }

    public function isEdited()
    {
        return $this->created_at != $this->updated_at ? '| (edited)' : null;
    }
}
