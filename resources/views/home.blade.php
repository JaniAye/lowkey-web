@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Featured Videos</h2>
    <div class="row">
        @if(isset($videos) && count($videos) > 0)
            @foreach ($videos as $video)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ url('/videos/' . $video['id']) }}">
                        <img src="{{ $video['thumbnail'] }}" class="card-img-top" alt="{{ $video['title'] }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ url('/videos/' . $video['id']) }}">{{ $video['title'] }}</a></h5>
                        <p class="card-text">{{ $video['uploader'] }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $video['price'] }}</p>
                        @if(isset($video['tags']) && count($video['tags']) > 0)
                        <p class="card-text">
                            <small class="text-muted">
                                Tags:
                                @foreach ($video['tags'] as $tag)
                                    <span class="badge bg-secondary">{{ $tag }}</span>
                                @endforeach
                            </small>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col">
                <p>No videos found.</p>
            </div>
        @endif
    </div>
</div>
@endsection
