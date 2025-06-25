@extends('layouts.app')

@section('content')
<style>
    .video-grid-container {
        padding-top: 20px;
    }
    .video-card {
        background-color: #f9f9f9; /* Slightly off-white background like YouTube's light theme */
        border: none; /* Remove default bootstrap border */
        margin-bottom: 25px;
        transition: box-shadow .2s ease-in-out;
    }
    .video-card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,.1);
    }
    .video-card .card-img-top-wrapper {
        position: relative;
        overflow: hidden; /* Ensures image stays within rounded corners if any */
        aspect-ratio: 16 / 9; /* Common video aspect ratio */
        background-color: #e0e0e0; /* Placeholder bg color */
    }
    .video-card .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Cover the area, might crop */
        transition: transform .2s ease-in-out;
    }
    .video-card:hover .card-img-top {
        transform: scale(1.05); /* Slight zoom on hover */
    }
    .video-card .card-body {
        padding: 10px;
    }
    .video-card .card-title a {
        font-size: 0.95rem;
        font-weight: 500;
        color: #030303;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.3;
        height: 2.6em; /* Approximation for 2 lines based on line-height */
    }
    .video-card .card-title a:hover {
        color: #000;
    }
    .video-card .card-text {
        font-size: 0.8rem;
        color: #606060; /* YouTube's secondary text color */
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .video-card .card-text.video-uploader {
        margin-bottom: 2px;
    }
    .video-card .card-text.video-price {
        font-weight: bold;
        color: #0f0f0f; /* Darker for price */
        margin-bottom: 6px;
    }
    .video-card .video-tags .badge {
        font-size: 0.7rem;
        padding: .25em .5em;
        margin-right: 4px;
        background-color: #e8e8e8;
        color: #606060;
        border: 1px solid #d8d8d8;
    }
    .video-card .video-tags {
         white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 1.8em; /* Limit height for tags */
    }
</style>

<div class="container video-grid-container">
    <h2 class="mb-4">Featured Videos</h2>
    <div class="row">
        @if(isset($videos) && count($videos) > 0)
            @foreach ($videos as $video)
            {{-- Use col-lg-3 for 4 cards on large screens, col-md-4 for 3 on medium, col-sm-6 for 2 on small --}}
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card video-card h-100">
                    <a href="{{ url('/videos/' . $video['id']) }}" class="card-img-top-wrapper">
                        <img src="{{ $video['thumbnail'] }}" class="card-img-top" alt="{{ $video['title'] }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">
                            <a href="{{ url('/videos/' . $video['id']) }}">{{ $video['title'] }}</a>
                        </h5>
                        <p class="card-text video-uploader">{{ $video['uploader'] }}</p>
                        <p class="card-text video-price"><strong>Price:</strong> ${{ $video['price'] }}</p>
                        @if(isset($video['tags']) && count($video['tags']) > 0)
                        <div class="video-tags mt-auto"> {{-- mt-auto to push tags to bottom if card body has extra space --}}
                            @foreach ($video['tags'] as $tag)
                                <span class="badge">{{ $tag }}</span>
                            @endforeach
                        </div>
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
