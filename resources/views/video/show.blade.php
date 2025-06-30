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
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<style>
    body {
        background-color: #f9f9f9; /* YouTube's light mode background */
        color: #0f0f0f; /* YouTube's primary text color */
    }
    .video-page-container-yt {
        margin-top: 20px;
        margin-bottom: 30px;
        max-width: 1700px; /* Max width like YouTube */
    }

    /* Main Video Content Area */
    #video-player-section-yt {
        aspect-ratio: 16 / 9; /* Maintain 16:9 aspect ratio */
        background-color: #000000; /* Black background for player area */
        border-radius: 12px; /* Rounded corners for player */
        overflow: hidden;
        position: relative; /* For absolute positioning of overlays/play buttons */
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
        font-size: 1.4rem; /* YouTube title size is around 20px */
        font-weight: 600;
        margin-top: 12px;
        margin-bottom: 8px;
        line-height: 1.3;
    }
    .video-info-yt .video-meta-yt {
        font-size: 0.9rem;
        color: #606060; /* YouTube secondary text color */
        margin-bottom: 10px;
    }
    .video-info-yt .video-actions-yt .btn {
        font-size: 0.85rem;
        padding: .3rem .7rem;
    }
    .video-info-yt .video-actions-yt .btn i {
        font-size: 1.1rem; /* Slightly larger icons */
        vertical-align: middle;
    }

    .uploader-info-yt img {
        width: 48px;
        height: 48px;
    }
    .uploader-info-yt .uploader-name-yt {
        font-size: 1rem;
        font-weight: 500;
    }
    .uploader-info-yt .subscriber-count-yt {
        font-size: 0.8rem;
        color: #606060;
    }
    .uploader-info-yt .btn-danger {
        background-color: #c00;
        border: none;
        font-size: 0.9rem;
        font-weight: 500;
        padding: .4rem 1rem;
    }

    .video-description-yt {
        font-size: 0.9rem;
        color: #0f0f0f;
        background-color: rgba(0,0,0,0.05) !important; /* YouTube's light gray for description box */
        border-radius: 8px;
        margin-top: 16px;
        line-height: 1.5;
    }
    .video-description-yt p {
        margin-bottom: 0.5rem;
    }


    /* Comments Section */
    .comments-section-yt.card {
        background-color: transparent; /* Make card background transparent */
        border: none; /* Remove card border */
    }
    .comments-section-yt .card-header {
        background-color: transparent;
        border-bottom: 1px solid #e0e0e0;
        padding-left: 0;
        padding-right: 0;
        font-size: 1.1rem;
        font-weight: 500;
    }
    .comments-section-yt .card-body {
        padding: 20px 0; /* Remove side padding */
    }
    .add-comment-yt {
        display: flex;
        align-items: center;
    }
    .add-comment-yt img {
        width: 40px;
        height: 40px;
    }
    .add-comment-yt .form-control {
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0;
        padding-left: 0;
        box-shadow: none;
    }
     .add-comment-yt .form-control:focus {
        border-bottom: 2px solid #0f0f0f;
     }

    .comment-yt {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #e9e9e9;
    }
    .comment-yt:last-child {
        border-bottom: none;
    }
    .comment-yt img {
        width: 40px;
        height: 40px;
    }
    .comment-yt strong {
        font-size: 0.85rem;
        font-weight: 500;
    }
    .comment-yt p {
        font-size: 0.9rem;
        line-height: 1.4;
        color: #0f0f0f;
    }
    .comment-actions-yt a {
        font-size: 0.8rem;
        color: #606060;
        text-decoration: none;
    }
    .comment-actions-yt a:hover {
        color: #0f0f0f;
    }
    .comment-actions-yt i {
        font-size: 0.9rem;
    }


    /* Sidebar: Suggested Videos */
    .video-sidebar-yt h4 {
        font-size: 1rem;
        font-weight: 500;
    }
    .suggested-video-yt .thumbnail-yt img {
        width: 168px; /* Standard YouTube suggested video thumbnail width */
        height: 94px; /* Standard YouTube suggested video thumbnail height */
        border-radius: 8px;
        object-fit: cover;
    }
    .suggested-video-yt .info-yt .title-yt {
        font-size: 0.9rem;
        font-weight: 500;
        color: #0f0f0f;
        line-height: 1.3;
        max-height: 2.6em; /* Limit to 2 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .suggested-video-yt .info-yt .channel-yt,
    .suggested-video-yt .info-yt .views-yt {
        font-size: 0.8rem;
        color: #606060;
    }
    .suggested-video-yt:hover .info-yt .title-yt {
        color: #cc0000; /* Or keep it black if preferred */
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
                            </div>
                        </div>
                    @endfor
                    <div class="mt-3">
                        <textarea class="form-control" rows="2" placeholder="Add a comment..."></textarea>
                        <button class="btn btn-primary btn-sm mt-2">Post Comment</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Video Player and Purchase Info -->
        <div class="col-lg-8 video-main-content order-lg-2">
            <div id="video-player-section" class="position-relative">
                {{-- This content will be dynamically updated by JavaScript --}}
            </div>
        </div>
    </div> <!-- End of the row for comments and video player -->

    <!-- Suggested Videos Section - moved outside and below the main content row -->
    <div id="suggested-videos-section" class="mt-4 pt-4 border-top">
        <div class="container-fluid"> {{-- Use container-fluid or container as needed for width control --}}
            <h3>Suggested Videos</h3>
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> {{-- Adjusted for potentially 4 items in a full row --}}
                        <div class="card suggestion-card">
                            <div class="suggestion-thumbnail">
                                <small>Thumbnail {{ $i + 1 }}</small>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">Suggested Video {{ $i + 1 }}</h6>
                                <p class="card-text"><small class="text-muted">Channel Name</small></p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

{{-- Initial state templates to be used by JavaScript --}}
<template id="video-locked-template">
    <div class="video-player-locked-state">
        <div class="video-player-background blurred"> {{-- Blur class might be adjusted/removed later --}}
            <div class="dummy-player-content" style="background-image: url('https://placehold.co/800x450/2d2d2d/e0e0e0?text=Video+Thumbnail'); position: relative;">
                {{-- Adding a fake play icon in the center to make it look more like a player --}}
                <div class="fake-play-icon-static">▶</div>
            </div>
        </div>
        <div class="purchase-overlay">
            <div class="overlay-content text-center">
                <div class="icon-lock mb-2" style="font-size: 2.5rem;">🔑</div>
                <h3>Unlock Video</h3>
                <p>Watch this video for only <strong class="video-price">{{ $videoPrice }}</strong></p>
                <button id="pay-to-watch-btn" class="btn btn-warning btn-lg">Pay {{ $videoPrice }} to Watch</button>
            </div>
        </div>
    </div>
</template>

<template id="video-player-template">
    <div class="video-player-unlocked-state">
        <div class="video-player-background">
            <div class="dummy-player-content" style="background-image: url('https://placehold.co/800x450/1a1a1a/e0e0e0?text=Video+Playing...'); position: relative;">
                {{-- The new smaller play button will be dynamically added here by JS --}}
            </div>
        </div>
    </div>
</template>

@endsection

@push('styles')
<style>
    body {
        background-color: #f4f7f6; /* Light gray background for the whole page */
    }
    .video-page-container {
        margin-top: 20px;
        margin-bottom: 30px;
    }

    /* Video Player Area (Right Column) */
    .video-main-content {
        /* padding-right: 25px; */ /* Original: space between video and comments */
        /* Now video is on right, comments on left, Bootstrap handles gutter */
    }

    #video-player-section {
        min-height: 450px; /* Ensure it has some height before JS loads content */
        background-color: #f0f0f0; /* Placeholder BG for the section itself */
        border-radius: 12px;
        overflow: hidden; /* Important for containing blurred elements */
    }

    /* Locked State Styling */
    .video-player-locked-state {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 450px; /* Match parent section */
    }
    .video-player-background { /* This class is on the container of dummy-player-content */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover; /* Should not be needed here if dummy-player-content has the bg image */
        background-position: center; /* Same as above */
        border-radius: 12px; /* Match parent container's rounding */
        /* If we want a border around the whole player area, it could go here or on #video-player-section */
    }
    /* Removing the .blurred class and its effects for now to make the player more identifiable */
    /* .video-player-background.blurred .dummy-player-content {
        filter: blur(8px);
        transform: scale(1.05);
    } */
    .dummy-player-content { /* This is the div with the background image */
        width: 100%;
        height: 100%;
        min-height: 450px; /* Ensure it fills the space */
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white; /* For any text inside, if needed */
        transition: filter 0.3s ease-in-out; /* Smooth transition for blur removal */
    }

    .purchase-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Dark semi-transparent overlay */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 12px; /* Match parent container's rounding */
    }
    .purchase-overlay .overlay-content {
        background-color: rgba(255, 255, 255, 0.95); /* Slightly transparent white card */
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        color: #333;
    }
    .purchase-overlay .icon-lock {
        color: #ffc107; /* Bootstrap warning yellow */
    }
    .purchase-overlay h3 {
        font-weight: 600;
        margin-bottom: 10px;
    }
    .purchase-overlay .video-price {
        color: #28a745; /* Bootstrap's success color */
        font-size: 1.2rem;
        font-weight: 700;
    }
    #pay-to-watch-btn { /* Specific ID for the pay button */
        background-color: #ffc107; /* Bootstrap warning yellow */
        border-color: #ffc107;
        color: #212529; /* Dark text for yellow button */
        padding: 10px 25px;
        font-size: 1.1rem;
        font-weight: bold;
        margin-top: 15px;
        transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
    }
    #pay-to-watch-btn:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    /* Unlocked State Styling */
    .video-player-unlocked-state {
        position: relative; /* For play button overlay */
        width: 100%;
        height: 100%;
        min-height: 450px; /* Match parent section */
    }
    .video-player-unlocked-state .play-button-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
        cursor: pointer;
        z-index: 5; /* Below purchase overlay if it were there, but above video content */
        transition: color 0.2s ease-in-out, transform 0.2s ease-in-out;
    }
    .video-player-unlocked-state .play-button-overlay:hover {
        color: rgba(255, 255, 255, 1); /* Fully opaque white */
        transform: translate(-50%, -50%) scale(1.1);
    }
    .video-player-unlocked-state .play-button-overlay svg {
        filter: drop-shadow(0 0 5px rgba(0,0,0,0.5)); /* Add a subtle shadow to the play icon */
    }


    /* Comments Section (Left Column) */
    .video-sidebar {
        padding-right: 20px; /* Add some space to its right, before video player column */
    }
    .video-sidebar .comments-section.card {
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        background-color: #fff;
    }
    .video-sidebar .comments-section .card-header {
        background-color: #f8f9fa; /* Light header */
        border-bottom: 1px solid #e0e0e0;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .video-sidebar .comments-section .card-header h4 {
        margin-bottom: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #343a40;
    }
    .comments-section .card-body {
        padding: 20px;
    }
    .comment {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee; /* Lighter separator */
    }
    .comment:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .comment img {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd; /* Subtle border for avatar */
    }
    .comment strong {
        color: #007bff; /* Highlight username */
    }
    .comment p {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.5;
    }
    .comments-section textarea.form-control {
        border-radius: 8px;
        border-color: #ced4da;
    }
    .comments-section .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 8px;
        font-weight: 500;
    }

    /* Suggested Videos Section */
    #suggested-videos-section h3 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #343a40;
        font-size: 1.5rem;
    }
    .suggestion-card.card {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        background-color: #fff;
    }
    .suggestion-card.card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.08);
    }
    .suggestion-card .suggestion-thumbnail {
        height: 130px; /* Slightly taller */
        background-color: #e9ecef; /* Lighter placeholder */
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-weight: 500;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .suggestion-card .card-body {
        padding: 12px;
    }
    .suggestion-card .card-title {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #343a40;
    }
    .suggestion-card .card-text small {
        font-size: 0.8rem;
        color: #6c757d;
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) { /* lg breakpoint */
        .video-main-content {
            padding-right: 15px; /* Reset padding */
            margin-bottom: 20px;
        }
        .video-player-wrapper .dummy-player {
            height: 350px; /* Adjust for smaller screens */
        }
    }
    @media (max-width: 767.98px) { /* md breakpoint */
        .video-player-wrapper .dummy-player {
            height: 250px;
        }
        .video-placeholder-locked {
            padding: 25px 15px;
        }
        .video-placeholder-locked .icon-lock {
            font-size: 2.5rem;
        }
        .video-placeholder-locked h3 {
            font-size: 1.5rem;
        }
        .video-placeholder-locked .video-price {
            font-size: 1.4rem;
        }
        #pay-to-watch-btn {
            padding: 10px 20px;
            font-size: 1rem;
        }
        .suggestion-card .suggestion-thumbnail {
            height: 110px;
        }
    }

    .dynamic-play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        border: 2px solid white;
        border-radius: 50%; /* Circular button */
        width: 60px;
        height: 60px;
        font-size: 24px; /* Size of the '▶' icon */
        line-height: 56px; /* Vertically center icon text, account for border */
        text-align: center; /* Horizontally center icon text */
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease;
        z-index: 5; /* Ensure it's above the dummy-player-content background image */
    }
    .dynamic-play-button:hover {
        background-color: rgba(0, 0, 0, 0.8);
        transform: translate(-50%, -50%) scale(1.1);
    }

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const videoPlayerSection = document.getElementById('video-player-section');
    const suggestedVideosSection = document.getElementById('suggested-videos-section');
    const videoLockedTemplateHTML = document.getElementById('video-locked-template').innerHTML;
    const videoPlayerTemplateHTML = document.getElementById('video-player-template').innerHTML;
    const videoPrice = "{{ $videoPrice }}"; // Get video price from PHP

    let hasPurchased = {{ $hasPurchasedInitially ? 'true' : 'false' }};

    function renderUI() {
        // Suggested videos are now always visible, so no JS manipulation needed for its display.
        if (hasPurchased) {
            videoPlayerSection.innerHTML = videoPlayerTemplateHTML;

            // Dynamically create and add the new smaller play button
            const dummyPlayerContent = videoPlayerSection.querySelector('.dummy-player-content');
            if (dummyPlayerContent) {
                const newPlayButton = document.createElement('div');
                newPlayButton.className = 'dynamic-play-button';
                newPlayButton.innerHTML = '▶'; // Play icon character

                newPlayButton.addEventListener('click', function() {
                    alert('Video playback would start now!');
                    newPlayButton.style.display = 'none'; // Hide the button after click
                    // Here you might also trigger actual video play if it were a real player
                });

                dummyPlayerContent.appendChild(newPlayButton);
            }

        } else {
            videoPlayerSection.innerHTML = videoLockedTemplateHTML;
            // CSS handles blur and overlay visibility based on classes in the template
            attachPayButtonListener();
        }
    }

    function attachPayButtonListener() {
        const payButton = document.getElementById('pay-to-watch-btn');
        if (payButton) {
            payButton.addEventListener('click', function() {
                // Updated confirmation message
                if (confirm(videoPrice + " will be deducted from your wallet. Pay Now?")) {
                    // No immediate alert, success is implied by UI change
                    hasPurchased = true;
                    renderUI(); // Re-render UI for unlocked state
                } else {
                    alert("Payment cancelled.");
                }
            });
        }
    }

    // Initial render
    renderUI();

    // Expose a way to test states
    window.testSetPurchased = function(status) {
        hasPurchased = status;
        renderUI();
    };
});
</script>
@endpush
