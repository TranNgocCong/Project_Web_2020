@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-3 p-5">

            @if ($user->stories->count() > 0)
                <a href="/stories/{{$user->username}}" >
                    <img src="{{ asset($user->profile->image )}}" class="border-linear  w-100">
                </a>
            @else
                <img src="{{ asset($user->profile->image) }}" class="rounded-circle w-100">
            @endif
        </div>

        <div class="col-9 pt-5">
            <div class="d-flex align-items-center">
                <h1>{{ $user->username }}</h1>

                @can('update', $user->profile)
                    <a class="btn btn-outline-secondary ml-3" href="/profile/{{$user->username}}/edit" role="button">
                        Edit Profile
                    </a>
                @else
                    <follow-button user-id="{{ $user->username }}" follows="{{ $follows }}"></follow-button>
                @endcan

            </div>
            <div class="d-flex">
                <div class="pr-5"><strong> {{ $postCount }} </strong> posts</div>
                <div class="pr-5"><strong> {{ $followersCount }} </strong> followers</div>
                <div class="pr-5"><strong> {{ $followingCount }} </strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold ">{{ $user->name }}</div>
            <div>
                {!! nl2br(e($user->profile->bio)) !!}
            </div>
            <div class="font-weight-bold">
                <a href="{{ $user->profile->website }}" target="_blanc">
                    {{ $user->profile->website }}
                </a>
            </div>

        </div>
    </div>

    <div class="row pt-4 border-top">

        @forelse ($user->posts as $post)
            <div class="col-4 col-md-4 mb-4 align-self-stretch">
                <a href="/p/{{ $post->id }}">
                    <img class="img border" height="300" src="{{ $post->image }}">
                </a>
            </div>
        @empty
            <div class="col-12 d-flex justify-content-center text-muted">
                <div class="card border-0 text-center bg-transparent" >
                    <img src="{{asset('img/noimage.png')}}" class="card-img-top" alt="...">
                    <div class="card-body ">
                        <h1>No Posts Yet</h1>
                    </div>
                </div>
            </div>
        @endforelse

    </div>
</div>
@endsection
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        encrypted: true,
        cluster: "ap1",
    });
    var channel = pusher.subscribe('my-channel');

    channel.bind('my-event', function(data) {
       
        var newNotificationHtml = `
        <p  class='mb-1'><a href="/profile/`+data.username.username+`" >`+data.username.username+`</a> `+data.data.body+`</p>
        `;

        $('.comments').append(newNotificationHtml);
        
    });
    });
    </script>