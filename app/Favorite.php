<?php

namespace Bolt;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Favorite extends Model
{
	protected $fillable = [
		'user_id',
	];

    public function favoritable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriter()
    {
        return $this->favoriter = $this->user;
    }

    public function scopeLiked($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->save();
    }

    public function scopeIsLiked($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsVideo($query)
    {
        return $query->isLiked()->where('favoritable_type', 'Bolt\Video');
    }

    public function activate()
    {
        $this->status = 1;
        $this->save();
    }
}
