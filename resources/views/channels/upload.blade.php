@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <channel-uploads inline-template>

        <div class="col-md-8">

            <div class="card p-3 d-flex justify-content-center align-items-center" v-if="!selected">

                <i onclick="document.getElementById('video-files').click()" class="fas fa-upload upload-icon"></i>

                <input type="file" ref="videos" class="d-none" id="video-files" @change="upload">
                <p class="text-center pt-3">Upload Videos</a>

            </div>

            <div class="card p-3">

            </div>

        </div>

        </channel-uploads>

    </div>
</div>
@endsection
