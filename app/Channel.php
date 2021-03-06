<?php

namespace FilmFest;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Channel extends Model implements HasMedia {

    use HasMediaTrait;

    public function user() {
        return  $this->belongsTo(User::class);
    }

    public function image() {
        // retrive the channel image

        // this is working for localhost. comment out when you go live! 
        $Fan = $this->getFirstMediaUrl('images', 'thumb');         
        $Tan = str_replace("http://localhost","","$Fan");        
        return $Tan; 

        // this the live code. not sure why it's not working
        // if( $this->media->first() ){
        //     return $this->media->first()->getFullUrl('thumb');
        // }

        // return null;
    }

    public function editable() {

        if(! auth()->check()) return false;

        return $this->user_id === auth()->user()->id;
    }

    public function registerMediaConversions(?Media $media = null) {
        // resize the image
        $this->addMediaConversion('thumb')->width(100)->height(100);
    }

    public function subscriptions() {

        return $this->hasMany(Subscription::class);

    }

    public function videos() {
        return $this->hasMany(Video::class);
    }

}
