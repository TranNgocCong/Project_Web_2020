@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($albums as $album)
                        @foreach ($album->albumimages as $img)
                            <div class="col-lg-3 col-md-4 col-6">
                                <div style="width:100%; text-align:center">
                                    <a href="{{ $img->image }}" data-lightbox="photos">
                                        <img src="{{ $img->image }}" class="img-thumbnail"
                                            style="width: 200px; height: 150px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                @foreach ($albums as $album)
                    <p>
                        Created By: <a
                            href="{{ route('profile.index', [$album->user->username]) }}">{{ $album->user->name }}</a>
                    </p>
                    <p>{{ $album->name }}</p>
                    <p>{{ $album->description }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
