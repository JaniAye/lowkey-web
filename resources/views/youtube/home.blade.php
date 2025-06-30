@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f1f1f1; /* Light gray background for the body */
    }
    .video-grid-container {
        padding-top: 20px;
        max-width: 1600px; /* Limit width for very large screens */
        margin-left: auto;
        margin-right: auto;
    }
    .video-grid-title {
        color: #030303;
        font-size: 1.5rem;
        font-weight: 600;
        border-bottom: 2px solid #cc0000; /* YouTube red accent */
        padding-bottom: 10px;
        display: inline-block;
    }
    .video-card {
        background-color: #ffffff; /* White background for cards */
        border: 1px solid #e0e0e0; /* Lighter border for cards */
        margin-bottom: 25px;
        transition: box-shadow .2s ease-in-out, transform .2s ease-in-out;
        border-radius: 8px; /* Slightly rounded corners for cards */
        overflow: hidden; /* Ensure content respects border radius */
    }
    .video-card:hover {
        box-shadow: 0 6px 12px rgba(0,0,0,.15);
        transform: translateY(-2px); /* Slight lift on hover */
    }
    .video-card .card-img-top-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 16 / 9;
        background-color: #000000; /* Black background for image wrapper */
    }
    .video-card .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s ease-in-out, opacity .3s ease-in-out;
    }
    .video-card:hover .card-img-top {
        transform: scale(1.1); /* More noticeable zoom on hover */
        opacity: 0.9;
    }
    .video-card .card-body {
        padding: 12px; /* Slightly more padding */
        background-color: #ffffff;
    }
    .video-card .card-title a {
        font-size: 1rem; /* Larger title font */
        font-weight: 500;
        color: #0f0f0f; /* Darker text for titles */
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4;
        height: 2.8em; /* Adjusted height for 2 lines */
    }
    .video-card .card-title a:hover {
        color: #cc0000; /* YouTube red on hover for titles */
    }
    .video-card .card-text {
        font-size: 0.85rem; /* Slightly larger secondary text */
        color: #505050; /* Darker gray for secondary text */
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .video-card .card-text.video-uploader {
        margin-bottom: 3px;
        font-weight: 500;
    }
    .video-card .card-text.video-price {
        font-weight: bold;
        color: #007bff; /* Blue for price, or choose another accent */
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    .video-card .video-tags .badge {
        font-size: 0.75rem;
        padding: .3em .6em;
        margin-right: 5px;
        margin-bottom: 5px; /* Spacing for wrapped tags */
        background-color: #e0e0e0; /* Lighter gray for tags */
        color: #404040; /* Darker text for tags */
        border: none;
        border-radius: 4px;
        display: inline-block; /* Ensure badges flow correctly */
    }
    .video-card .video-tags {
        white-space: normal; /* Allow tags to wrap */
        overflow: visible; /* Allow tags to wrap */
        height: auto; /* Auto height for tags area */
        line-height: 1.3;
    }

    /* Responsive adjustments for smaller screens */
    @media (max-width: 768px) {
        .video-grid-title {
            font-size: 1.3rem;
        }
        .video-card .card-title a {
            font-size: 0.9rem;
            height: 2.6em; /* Adjust for smaller font */
        }
        .video-card .card-text {
            font-size: 0.8rem;
        }
    }
</style>

<div class="container-fluid video-grid-container"> {{-- Changed to container-fluid for wider layout, controlled by max-width --}}
    <h2 class="mb-4 video-grid-title">Explore Videos</h2>
    <div class="row">
        @if(isset($videos) && count($videos) > 0)
            @foreach ($videos as $video)
            {{-- Use col-xl-2 for 6 cards on XL, col-lg-3 for 4, col-md-4 for 3, col-sm-6 for 2, col-12 for 1 --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                <div class="card video-card h-100">
                    {{-- Ensure the link points to the video show page --}}
                    <a href="{{ route('videos.show', ['id' => $video['id']]) }}" class="card-img-top-wrapper">
                        <img src="{{ $video['thumbnail'] }}" class="card-img-top" alt="{{ $video['title'] }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">
                             {{-- Ensure the link points to the video show page --}}
                            <a href="{{ route('videos.show', ['id' => $video['id']]) }}">{{ $video['title'] }}</a>
                        </h5>
                        <p class="card-text video-uploader">{{ $video['uploader'] }}</p>
                        {{-- Assuming 'price' is not typical for YouTube, commenting out or could be 'views' --}}
                        {{-- <p class="card-text video-price"><strong>Price:</strong> ${{ $video['price'] }}</p> --}}
                        <p class="card-text video-views"> {{-- Example: replace price with views --}}
                            {{-- <strong>Views:</strong> {{ number_format(rand(1000, 1000000)) }} --}} {{-- Placeholder for views --}}
                        </p>
                        @if(isset($video['tags']) && count($video['tags']) > 0)
                        <div class="video-tags mt-auto">
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
