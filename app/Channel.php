<?php

namespace FilmFest;


class Channel extends Model {
    

    public function user() {
        return  $this->belongsTo(User::class);
    }

}
