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
        <!-- Left Column: Video Player and Purchase Info -->
        <div class="col-lg-8 video-main-content">
            <div id="video-player-section">
                {{-- This content will be dynamically updated by JavaScript --}}
            </div>

            <div id="suggested-videos-section" class="mt-4" style="display: none;">
                <h3>Suggested Videos</h3>
                <div class="row">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card suggestion-card">
                                <div class="suggestion-thumbnail" style="height: 120px; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center;">
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

        <!-- Right Column: Comments Section -->
        <div class="col-lg-4 video-sidebar">
            <div class="comments-section card">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="comment mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-start">
                                <img src="https://via.placeholder.com/40?text=User{{$i+1}}" class="rounded-circle me-2" alt="User Avatar">
                                <div>
                                    <strong>User {{ $i + 1 }}</strong> <small class="text-muted ms-2">{{ $i*2 + 1 }} hours ago</small>
                                    <p class="mt-1 mb-0">This is a fake comment. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
    </div>
</div>

{{-- Initial state templates to be used by JavaScript --}}
<template id="video-locked-template">
    <div class="video-placeholder-locked"> {{-- Removed card and text-center as styles are now more specific --}}
        <div class="icon-lock">🔒</div>
        <h3>Video Locked</h3>
        <p>You need to purchase this video to watch it.</p>
        <div class="video-price mb-3">{{ $videoPrice }}</div> {{-- Changed h4 to div for more flexible styling --}}
        <button id="pay-to-watch-btn" class="btn btn-primary btn-lg">Pay to Watch</button> {{-- Adjusted button class for new styles --}}
    </div>
</template>

<template id="video-player-template">
    <div class="video-player-wrapper">
        {{-- Dummy video player --}}
        <div class="dummy-player"> {{-- Added class for specific styling --}}
            <h2>Dummy Video Player</h2>
            <p>(Video content would be here)</p>
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

    /* Video Player and Purchase Info Area */
    .video-main-content {
        padding-right: 25px; /* Space between video and comments */
    }
    .video-placeholder-locked {
        background-color: #fff;
        padding: 40px 20px;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        text-align: center;
    }
    .video-placeholder-locked .icon-lock {
        font-size: 3.5rem;
        color: #6c757d; /* Bootstrap's secondary color */
        margin-bottom: 15px;
    }
    .video-placeholder-locked h3 {
        color: #343a40; /* Bootstrap's dark color */
        font-weight: 600;
    }
    .video-placeholder-locked .video-price {
        color: #28a745; /* Bootstrap's success color */
        font-size: 1.75rem;
        font-weight: 700;
        margin: 10px 0 20px;
    }
    #pay-to-watch-btn {
        background-color: #007bff; /* Bootstrap's primary blue */
        border-color: #007bff;
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: 500;
        transition: background-color 0.2s ease-in-out;
    }
    #pay-to-watch-btn:hover {
        background-color: #0056b3;
    }

    .video-player-wrapper .dummy-player {
        background-color: #000;
        color: #fff;
        height: 480px; /* Adjusted height */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 12px; /* Softer corners */
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
    .video-player-wrapper .dummy-player h2 {
        margin-bottom: 10px;
        font-size: 1.8rem;
    }

    /* Comments Section */
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
    const videoLockedTemplate = document.getElementById('video-locked-template').innerHTML;
    const videoPlayerTemplate = document.getElementById('video-player-template').innerHTML;

    let hasPurchased = {{ $hasPurchasedInitially ? 'true' : 'false' }}; // Default state

    function renderUI() {
        if (hasPurchased) {
            videoPlayerSection.innerHTML = videoPlayerTemplate;
            suggestedVideosSection.style.display = 'block';
        } else {
            videoPlayerSection.innerHTML = videoLockedTemplate;
            suggestedVideosSection.style.display = 'none';
            attachPayButtonListener();
        }
    }

    function attachPayButtonListener() {
        const payButton = document.getElementById('pay-to-watch-btn');
        if (payButton) {
            payButton.addEventListener('click', function() {
                if (confirm("This amount will reduce in your wallet. Confirm to proceed?")) {
                    alert("Payment successful! Video unlocked."); // Simulating success
                    hasPurchased = true;
                    renderUI(); // Re-render the UI to show the video player and suggestions
                } else {
                    alert("Payment cancelled.");
                }
            });
        }
    }

    // Initial render
    renderUI();

    // Expose a way to test the "already purchased" state if needed for development
    // e.g., type in console: testSetPurchased(true)
    window.testSetPurchased = function(status) {
        hasPurchased = status;
        renderUI();
    }
});
</script>
@endpush
