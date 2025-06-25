@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Video Details</div>

                <div class="card-body">
                    {{-- For now, just display the video ID. We can enhance this later. --}}
                    <h1>Video ID: {{ $videoId ?? 'Not found' }}</h1>
                    <p>Details about the video will go here.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
