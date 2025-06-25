@extends('layouts.app')

@section('content')
@php
    // Simulate purchase status - this will be controlled by JavaScript later
    // For initial testing, we can set this to true or false.
    // Let's assume it's false by default for a user who hasn't paid.
    $hasPurchasedInitially = false;
    $videoPrice = '$10.00'; // Example price
@endphp

<div class="container-fluid video-page-container">
    <div class="row">
        <!-- Left Column: Comments Section -->
        <div class="col-lg-4 video-sidebar order-lg-1">
            <div class="comments-section card">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body" style="max-height: 600px; overflow-y: auto;"> {{-- Increased max-height slightly --}}
                    @for ($i = 0; $i < 7; $i++) {{-- Increased comment count for testing scroll --}}
                        <div class="comment mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-start">
                                <img src="https://via.placeholder.com/40?text=U{{$i+1}}" class="rounded-circle me-2" alt="User Avatar">
                                <div>
                                    <strong>User {{ $i + 1 }}</strong> <small class="text-muted ms-2">{{ $i*2 + 1 }} hours ago</small>
                                    <p class="mt-1 mb-0">This is a fake comment. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
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
        <div class="video-player-background blurred">
            {{-- This will be the actual player structure, but blurred --}}
            <div class="dummy-player-content" style="background-image: url('https://via.placeholder.com/800x450/000000/FFFFFF?text=Video+Content+Preview');">
                 {{-- Using a background image for the dummy player for blur effect --}}
            </div>
        </div>
        <div class="purchase-overlay">
            <div class="overlay-content text-center">
                <div class="icon-lock mb-2" style="font-size: 2.5rem;">🔑</div> {{-- Changed icon slightly --}}
                <h3>Unlock Video</h3>
                <p>Watch this video for only <strong class="video-price">{{ $videoPrice }}</strong></p>
                <button id="pay-to-watch-btn" class="btn btn-warning btn-lg">Pay {{ $videoPrice }} to Watch</button>
            </div>
        </div>
    </div>
</template>

<template id="video-player-template">
    <div class="video-player-unlocked-state">
        <div class="video-player-background"> {{-- Not blurred --}}
            <div class="dummy-player-content" style="background-image: url('https://via.placeholder.com/800x450/000000/FFFFFF?text=Video+Playing');">
                {{-- In a real scenario, an <video> tag or iframe would go here --}}
                <div class="play-button-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                    </svg>
                </div>
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
    .video-player-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 12px; /* Match parent container's rounding */
    }
    .video-player-background.blurred .dummy-player-content {
        filter: blur(8px); /* Adjust blur intensity as needed */
        transform: scale(1.05); /* Slight scale to prevent blurred edges from showing background */
    }
    .dummy-player-content {
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
            // No blur, no purchase overlay. Play button is part of the template.

            // Optional: Add event listener for the play button if it's not just visual
            const playButton = videoPlayerSection.querySelector('.play-button-overlay');
            if(playButton) {
                playButton.addEventListener('click', function() {
                    alert('Video playback would start now!');
                    // Potentially hide the play button itself or change its state
                    playButton.style.display = 'none';
                });
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
