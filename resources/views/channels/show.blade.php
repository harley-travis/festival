@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ $channel->name }}

                    <a href="{{ route('channel.upload', $channel->id ) }}">Upload Videos</a>

                </div>

                <div class="card-body">
                    
                    @if( $channel->editable() )

                    <form id="update-channel-form" action="{{ route('channels.update', $channel->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                    @endif

                        <div class="form-group row justify-content-center">
                            <div class="channel-avatar">
                                @if( $channel->editable() )

                                <div onclick="document.getElementById('image').click()" class="channel-avatar-overlay">
                                    
                                        <!-- insert image here -->
                                    
                                </div>

                                @endif
                                <img src="{{ $channel->image() }}" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                        <!-- there is a bug in teh code where if you add an apostraphe, then it breaks the __auth code -->
                            <h4 class="text-center">{{ $channel->name }}</h4>
                            <p class="text-center">{{ $channel->description }}</p>

                            <div class="text-center">

                                <subscribe-button :channel="{{ $channel }}" :inital-subscriptions="{{ $channel->subscriptions }}" inline-template>

                                    <button @click="toggleSubscription" class="btn btn-danger">
                                        @{{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe' }} @{{ count}} @{{ owner ? 'Subscribers' : '' }}
                                    </button>

                                </subscribe-button>
                            </div>

                        </div>

                        @if( $channel->editable() )

                            <input onchange="document.getElementById('update-channel-form').submit()" type="file" name="image" id="image" class="d-none">

                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input id="name" name="name" value="{{ $channel->name }}" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-control-label">Description</label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{ $channel->description }}</textarea>
                            </div>

                            <!-- validation -->
                            @if($errors->any())
                                <ul class="list-group mb-5">    
                                    @foreach($errors->all() as $error )
                                    <li class="text-danger list-group-item">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <button class="btn btn-primary" type="submit">Update Channel</button>

                        @endif

                    @if( $channel->editable() )
                    </form> 
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
