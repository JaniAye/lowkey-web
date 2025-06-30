@extends('layouts.app')

@section('content')
@php
    // Simulate purchase status - this will be controlled by JavaScript later
    // For initial testing, we can set this to true or false.
    // Let's assume it's false by default for a user who hasn't paid.
    $hasPurchasedInitially = false;
    $videoPrice = '$10.00'; // Example price
    // Sample data for video details (in a real app, this would come from the controller)
    $videoTitle = "Amazing Video Title - Episode " . $videoId;
    $videoUploader = "ContentCreator123";
    $videoViews = rand(10000, 5000000);
    $videoUploadDate = now()->subDays(rand(1, 365))->toFormattedDateString();
    $videoDescription = "This is a sample description for the video. It can be a bit longer and provide more details about the content. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
@endphp

<div class="container-fluid video-page-container-yt"> {{-- Added -yt suffix for new styles --}}
    <div class="row gx-4"> {{-- gx-4 for gutter spacing --}}
        <!-- Main Video Content Column -->
        <div class="col-lg-8 video-main-content-yt">
            <div id="video-player-section-yt" class="mb-3">
                {{-- This content will be dynamically updated by JavaScript --}}
            </div>
            <div class="video-info-yt">
                <h1 class="video-title-yt">{{ $videoTitle }}</h1>
                <div class="video-meta-yt d-flex justify-content-between align-items-center">
                    <div>
                        <span class="view-count-yt">{{ number_format($videoViews) }} views</span>
                        <span class="upload-date-yt"> • {{ $videoUploadDate }}</span>
                    </div>
                    <div class="video-actions-yt">
                        <button class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-hand-thumbs-up"></i> {{ number_format(rand(100,10000)) }}</button>
                        <button class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-hand-thumbs-down"></i> {{ number_format(rand(10,500)) }}</button>
                        <button class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-share"></i> Share</button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i> Download</button>
                    </div>
                </div>
                <hr>
                <div class="uploader-info-yt d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/48?text=U" class="rounded-circle me-3" alt="Uploader Avatar">
                    <div>
                        <h5 class="uploader-name-yt mb-0">{{ $videoUploader }}</h5>
                        <small class="subscriber-count-yt">{{ number_format(rand(500, 100000)) }} subscribers</small>
                    </div>
                    <button class="btn btn-danger ms-auto">Subscribe</button>
                </div>
                <div class="video-description-yt bg-light p-3 rounded">
                    <p>{{ $videoDescription }}</p>
                </div>
            </div>
             <!-- Comments Section (Moved under video info in the left column) -->
            <div class="comments-section-yt card mt-4">
                <div class="card-header">
                    <h4>{{ number_format(rand(50,1000)) }} Comments</h4>
                </div>
                <div class="card-body">
                    <div class="add-comment-yt mb-3">
                        <img src="https://via.placeholder.com/40?text=Me" class="rounded-circle me-2" alt="My Avatar">
                        <input type="text" class="form-control form-control-sm" placeholder="Add a comment...">
                        {{-- <button class="btn btn-primary btn-sm mt-2">Post Comment</button> --}}
                    </div>
                    @for ($i = 0; $i < 7; $i++)
                        <div class="comment-yt mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-start">
                                <img src="https://via.placeholder.com/40?text=U{{$i+1}}" class="rounded-circle me-2" alt="User Avatar">
                                <div>
                                    <strong>User {{ $i + 1 }}</strong> <small class="text-muted ms-2">{{ $i*2 + 1 }} hours ago</small>
                                    <p class="mt-1 mb-0">This is a fake YouTube style comment. Much more engaging! Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="comment-actions-yt">
                                        <a href="#" class="me-2"><i class="bi bi-hand-thumbs-up"></i> {{ rand(0,50) }}</a>
                                        <a href="#" class="me-2"><i class="bi bi-hand-thumbs-down"></i></a>
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Sidebar: Suggested Videos -->
        <div class="col-lg-4 video-sidebar-yt">
            <h4 class="mb-3">Up next</h4>
            @for ($i = 0; $i < 10; $i++)
            <a href="{{ route('videos.show', ['id' => $videoId + $i + 1]) }}" class="text-decoration-none text-dark">
                <div class="suggested-video-yt d-flex mb-3">
                    <div class="thumbnail-yt me-2">
                        <img src="https://via.placeholder.com/168x94?text=Video+{{$videoId + $i + 1}}" alt="Suggested video thumbnail">
                    </div>
                    <div class="info-yt">
                        <h6 class="title-yt mb-1">Suggested Video Title {{ $i + 1 }} - A very interesting topic indeed</h6>
                        <small class="channel-yt text-muted">Another Creator</small><br>
                        <small class="views-yt text-muted">{{ number_format(rand(1000, 200000)) }} views</small>
                    </div>
                </div>
            </a>
            @endfor
        </div>
    </div>
</div>

{{-- Initial state templates to be used by JavaScript --}}
<template id="video-locked-template-yt">
    <div class="video-player-locked-state-yt">
        <div class="video-player-background-yt" style="background-image: url('https://placehold.co/800x450/2d2d2d/e0e0e0?text=Video+{{$videoId}}+Thumbnail');">
            {{-- Static play icon for locked state --}}
            <div class="fake-play-icon-static-yt">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/>
                </svg>
            </div>
        </div>
        <div class="purchase-overlay-yt">
            <div class="overlay-content-yt text-center">
                <div class="icon-lock-yt mb-2" style="font-size: 2.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
                    </svg>
                </div>
                <h3>Unlock Video</h3>
                <p>Watch this video for only <strong class="video-price-yt">{{ $videoPrice }}</strong></p>
                <button id="pay-to-watch-btn-yt" class="btn btn-danger btn-lg">Pay {{ $videoPrice }} to Watch</button>
            </div>
        </div>
    </div>
</template>

<template id="video-player-template-yt">
    <div class="video-player-unlocked-state-yt">
        {{-- Actual video player (e.g., <video> tag or iframe) would go here --}}
        {{-- For this example, using a placeholder with a dynamic play button --}}
        <div class="dummy-player-content-yt" style="background-image: url('https://placehold.co/800x450/1a1a1a/e0e0e0?text=Video+{{$videoId}}+Playing...');">
            {{-- Dynamic play button will be added here by JS --}}
        </div>
    </div>
</template>

@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<style>
    body {
        background-color: #f1f1f1; /* Slightly lighter gray than #f9f9f9 for a softer look */
        color: #0f0f0f; /* YouTube's primary text color */
        font-family: 'Roboto', sans-serif; /* Standard YouTube font */
    }
    .video-page-container-yt {
        padding-top: 24px; /* Standard YouTube top padding */
        padding-bottom: 24px;
        max-width: calc(1280px + 2 * 24px); /* Based on common YouTube content width + padding */
        margin-left: auto;
        margin-right: auto;
    }

    /* Main Video Content Area */
    #video-player-section-yt {
        aspect-ratio: 16 / 9;
        background-color: #000000;
        border-radius: 12px; /* Keep rounded corners */
        overflow: hidden;
        position: relative;
        margin-bottom: 16px; /* Space below player */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Subtle shadow for depth */
    }

    /* Locked State Styling */
    .video-player-locked-state-yt {
        width: 100%;
        height: 100%;
        position: relative;
    }
    .video-player-background-yt {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fake-play-icon-static-yt svg {
        color: rgba(255, 255, 255, 0.7);
        filter: drop-shadow(0 0 8px rgba(0,0,0,0.5));
    }
    .purchase-overlay-yt {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        color: #fff;
    }
    .purchase-overlay-yt .overlay-content-yt {
        background-color: rgba(30, 30, 30, 0.9); /* Darker, slightly transparent card */
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    }
    .purchase-overlay-yt .icon-lock-yt svg {
        color: #ffcc00; /* A gold-ish yellow */
    }
    .purchase-overlay-yt h3 {
        font-weight: 600;
        margin-bottom: 10px;
    }
    .purchase-overlay-yt .video-price-yt {
        color: #ffcc00;
        font-size: 1.2rem;
        font-weight: 700;
    }
    #pay-to-watch-btn-yt {
        background-color: #ff0000; /* YouTube Red */
        border-color: #ff0000;
        color: #fff;
        padding: 10px 25px;
        font-size: 1.1rem;
        font-weight: bold;
        margin-top: 15px;
        transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
    }
    #pay-to-watch-btn-yt:hover {
        background-color: #cc0000;
        border-color: #cc0000;
    }

    /* Unlocked State Styling */
    .video-player-unlocked-state-yt {
        width: 100%;
        height: 100%;
    }
    .dummy-player-content-yt { /* This is the div with the background image for the player */
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        position: relative; /* For dynamic play button */
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .dynamic-play-button-yt {
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .dynamic-play-button-yt svg {
        width: 36px; /* Size of the play icon itself */
        height: 36px;
    }
    .dynamic-play-button-yt:hover {
        background-color: rgba(0, 0, 0, 0.8);
        transform: scale(1.1);
    }

    /* Video Info Below Player */
    .video-info-yt .video-title-yt {
        font-size: 20px; /* YouTube title size */
        font-weight: 600; /* Bolder */
        margin-top: 0; /* Player has margin-bottom */
        margin-bottom: 8px;
        line-height: 1.35;
        color: #0f0f0f;
    }
    .video-info-yt .video-meta-yt {
        font-size: 14px; /* YouTube meta text size */
        color: #606060;
        margin-bottom: 12px; /* More space before actions */
    }
    .video-info-yt .video-actions-yt .btn {
        background-color: rgba(0,0,0,0.05); /* Light gray background for buttons */
        border: none;
        color: #0f0f0f;
        font-size: 14px; /* Standard button text size */
        font-weight: 500;
        padding: 6px 12px; /* Adjust padding */
        border-radius: 18px; /* Pill-shaped buttons */
    }
    .video-info-yt .video-actions-yt .btn:hover {
        background-color: rgba(0,0,0,0.1);
    }
    .video-info-yt .video-actions-yt .btn i {
        font-size: 18px; /* Icon size */
        vertical-align: text-bottom; /* Better alignment */
        margin-right: 6px; /* Space between icon and text */
    }
     .video-info-yt .video-actions-yt .btn:last-child {
        margin-right: 0;
    }


    .uploader-info-yt img {
        width: 40px; /* Standard avatar size */
        height: 40px;
    }
    .uploader-info-yt .uploader-name-yt {
        font-size: 16px; /* Standard name size */
        font-weight: 500;
        color: #0f0f0f;
    }
    .uploader-info-yt .subscriber-count-yt {
        font-size: 12px; /* Smaller text for subscriber count */
        color: #606060;
    }
    .uploader-info-yt .btn-danger { /* Subscribe button */
        background-color: #cc0000; /* YouTube red */
        border: none;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 16px; /* Standard button padding */
        border-radius: 18px; /* Pill shape */
    }
     .uploader-info-yt .btn-danger:hover {
        background-color: #990000; /* Darker red on hover */
    }

    .video-description-yt {
        font-size: 14px;
        color: #0f0f0f;
        background-color: rgba(0,0,0,0.05);
        border-radius: 12px; /* More rounded corners */
        padding: 12px 16px; /* Adjust padding */
        margin-top: 16px;
        line-height: 1.6; /* Better readability */
        cursor: pointer; /* To indicate it's expandable */
    }
    .video-description-yt p {
        margin-bottom: 4px;
    }
    .video-description-yt strong { /* For "Show more/less" */
        font-weight: 500;
        color: #065fd4; /* YouTube blue link color */
    }


    /* Comments Section */
    .comments-section-yt { /* Removed .card styling, treat as a block */
        margin-top: 24px;
    }
    .comments-section-yt .card-header { /* This is now just a heading for comments count */
        background-color: transparent;
        border-bottom: none; /* No line under "Comments" header text */
        padding: 0 0 16px 0; /* Space below comments count */
        font-size: 18px; /* Comments count text size */
        font-weight: 500;
        color: #0f0f0f;
    }
    .comments-section-yt .card-body {
        padding: 0; /* No padding for the body, direct children will have margins */
    }
    .add-comment-yt {
        display: flex;
        align-items: center;
        margin-bottom: 24px; /* Space after add comment field */
    }
    .add-comment-yt img { /* User avatar for new comment */
        width: 40px;
        height: 40px;
        margin-right: 12px;
    }
    .add-comment-yt .form-control {
        border: none;
        border-bottom: 1px solid #cccccc; /* Lighter bottom border */
        border-radius: 0;
        padding: 8px 0; /* Adjust padding */
        font-size: 14px;
        box-shadow: none;
        background-color: transparent;
    }
     .add-comment-yt .form-control:focus {
        border-bottom: 2px solid #0f0f0f; /* Standard focus indicator */
     }

    .comment-yt {
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #e0e0e0; /* Lighter separator for comments */
    }
    .comment-yt:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .comment-yt img { /* Commenter's avatar */
        width: 40px;
        height: 40px;
        margin-right: 12px;
    }
    .comment-yt strong { /* Commenter's name */
        font-size: 13px; /* Slightly smaller name */
        font-weight: 500;
        color: #0f0f0f;
        margin-right: 6px;
    }
    .comment-yt small.text-muted { /* Timestamp */
        font-size: 12px;
        color: #606060;
    }
    .comment-yt p { /* Comment text */
        font-size: 14px;
        line-height: 1.5;
        color: #0f0f0f;
        margin-top: 4px; /* Space between name/timestamp and text */
    }
    .comment-actions-yt {
        margin-top: 8px;
    }
    .comment-actions-yt a {
        font-size: 12px; /* Smaller action links */
        color: #606060;
        text-decoration: none;
        margin-right: 16px; /* Space between actions */
    }
    .comment-actions-yt a:hover {
        color: #0f0f0f;
    }
    .comment-actions-yt i {
        font-size: 16px; /* Icon size for like/dislike */
        vertical-align: text-bottom;
    }


    /* Sidebar: Suggested Videos */
    .video-sidebar-yt {
        padding-left: 24px;
    }
    .video-sidebar-yt > h4 { /* "Up next" heading, direct child */
        font-size: 16px;
        font-weight: 500;
        color: #0f0f0f;
        margin-bottom: 16px; /* More space below "Up next" */
    }
    .suggested-video-yt { /* Container for each suggested video item */
        display: flex;
        margin-bottom: 8px; /* Tighter spacing between suggested videos */
        align-items: flex-start; /* Align items to the top */
    }
    .suggested-video-yt .thumbnail-yt {
        margin-right: 8px; /* Space between thumbnail and info */
    }
    .suggested-video-yt .thumbnail-yt img {
        width: 160px; /* Slightly smaller thumbnail */
        height: 90px;
        border-radius: 4px; /* Less pronounced radius */
        object-fit: cover;
        background-color: #e0e0e0; /* Placeholder bg */
    }
    .suggested-video-yt .info-yt .title-yt {
        font-size: 14px; /* Standard text size for titles */
        font-weight: 500;
        color: #0f0f0f;
        line-height: 1.4;
        max-height: 2.8em; /* Approx 2 lines with 1.4 line-height */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        margin-bottom: 4px; /* Space below title */
    }
    .suggested-video-yt .info-yt .channel-yt,
    .suggested-video-yt .info-yt .views-yt {
        font-size: 12px; /* Smaller text for channel/views */
        color: #606060;
        line-height: 1.3;
    }
    .suggested-video-yt:hover .info-yt .title-yt {
        color: #030303; /* Standard hover for links, no red needed here */
    }
    .suggested-video-yt:hover {
        background-color: rgba(0,0,0,0.03); /* Subtle hover for the whole item */
        border-radius: 4px;
    }


    /* Responsive adjustments */
    @media (max-width: 991.98px) { /* lg breakpoint */
        .video-sidebar-yt {
            margin-top: 30px;
        }
        .video-info-yt .video-title-yt {
            font-size: 1.25rem;
        }
    }
    @media (max-width: 767.98px) { /* md breakpoint */
        .video-info-yt .video-meta-yt {
            flex-direction: column;
            align-items: flex-start;
        }
        .video-info-yt .video-actions-yt {
            margin-top: 10px;
        }
         .uploader-info-yt {
            flex-direction: column;
            align-items: flex-start;
        }
        .uploader-info-yt .btn-danger {
            margin-left: 0 !important;
            margin-top: 10px;
        }
    }

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const videoPlayerSection = document.getElementById('video-player-section-yt');
    // const suggestedVideosSection = document.getElementById('suggested-videos-section'); // Not used in this version's JS
    const videoLockedTemplateHTML = document.getElementById('video-locked-template-yt').innerHTML;
    const videoPlayerTemplateHTML = document.getElementById('video-player-template-yt').innerHTML;
    const videoPrice = "{{ $videoPrice }}"; // Get video price from PHP

    let hasPurchased = {{ $hasPurchasedInitially ? 'true' : 'false' }};

    function renderUI() {
        if (!videoPlayerSection) {
            console.error('Video player section not found!');
            return;
        }

        if (hasPurchased) {
            videoPlayerSection.innerHTML = videoPlayerTemplateHTML;

            const dummyPlayerContent = videoPlayerSection.querySelector('.dummy-player-content-yt');
            if (dummyPlayerContent) {
                // Check if play button already exists
                if (!dummyPlayerContent.querySelector('.dynamic-play-button-yt')) {
                    const newPlayButton = document.createElement('div');
                    newPlayButton.className = 'dynamic-play-button-yt';
                    // Bootstrap Play Icon SVG
                    newPlayButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                    </svg>`;

                    newPlayButton.addEventListener('click', function() {
                        alert('Video playback would start now! (Video ID: {{ $videoId }})');
                        // Instead of hiding, you might replace dummy content with actual player
                        dummyPlayerContent.innerHTML = '<p style="color:white; text-align:center; font-size:1.2rem;">Video is "playing"...</p>';
                    });
                    dummyPlayerContent.appendChild(newPlayButton);
                }
            }
        } else {
            videoPlayerSection.innerHTML = videoLockedTemplateHTML;
            attachPayButtonListener();
        }
    }

    function attachPayButtonListener() {
        const payButton = document.getElementById('pay-to-watch-btn-yt');
        if (payButton) {
            payButton.addEventListener('click', function() {
                if (confirm(videoPrice + " will be deducted from your wallet. Pay Now?")) {
                    hasPurchased = true;
                    renderUI();
                } else {
                    // alert("Payment cancelled."); // Optional: notify cancellation
                }
            });
        }
    }

    renderUI();

    window.testSetPurchased = function(status) {
        hasPurchased = status;
        renderUI();
    };
});
</script>
@endpush
