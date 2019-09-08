<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function upvotes()
    {
        return $this->belongsToMany(User::class, 'contribution_user', 'contribution_id', 'user_id');
    }
}
