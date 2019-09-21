<?php

namespace FilmFest\Http\Controllers;

use FilmFest\Channel;
use Illuminate\Http\Request;

class UploadVideoController extends Controller {
    
    public function index(Channel $channel) {

        return view('channels.upload', [
            'channel' => $channel
        ]);

    }


}
