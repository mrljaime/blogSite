<?php

class Note extends Eloquent{

    protected $table = 'note';

    public function user()
    {
        return $this->hasOne('user', 'uid', 'user_uid');
    }

    /*
    public function cover()
    {
        return $this->hasOne('cover', 'uid', 'cover_uid');
    }

    public function banner()
    {
        return $this->hasOne('banner', 'uid', 'baner_uid');
    }

    */
}