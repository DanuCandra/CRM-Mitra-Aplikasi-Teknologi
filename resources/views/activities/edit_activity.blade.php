@extends('layouts.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Activity for {{ $prospect->first_name }} {{ $prospect->last_name }}</h1>

        <!-- Form Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Activity</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Activity Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Enter activity title"
                            value="{{ $activity->title }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                            rows="4" placeholder="Enter activity details" required>{{ $activity->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date & Time -->
                    <div class="form-group">
                        <label for="date_time">Activity Date & Time</label>
                        <input type="datetime-local" name="date_time" id="date_time"
                            class="form-control @error('date_time') is-invalid @enderror" value="{{ $activity->date_time }}"
                            required>
                        @error('date_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Update Activity</button>
                    <a href="{{ url('/activities/view-activities/' . $prospect->id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>
@endsection
