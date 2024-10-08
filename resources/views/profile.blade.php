@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Profile</h1>
        <div class="profile-container">
            <!-- Profile Information Section -->
            <div class="profile-info">
                <div class="profile-image">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                    @else
                        <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Picture">
                    @endif
                </div>
                <div class="profile-details">
                    <h2>{{ $user->name }}</h2>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
            </div>

            <!-- Add buttons for editing profile and going back to photos -->
            <div class="button-group">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('photos.index') }}" class="btn btn-secondary">Back to Photos</a>
            </div>

            <!-- User's Uploaded Photos Section -->
            <div class="uploaded-photos mt-5">
                <h3>{{ $user->name }}'s Uploaded Photos</h3>
                <div class="row">
                    @if($user->photos->isEmpty())
                        <p>No photos uploaded yet.</p>
                    @else
                        @foreach($user->photos as $photo)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $photo->image_path) }}" class="card-img-top" alt="Photo">
                                    <div class="card-body">
                                        <p>{{ $photo->caption }}</p>
                                        <small>{{ $photo->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .profile-container {
        max-width: 600px; /* Set a maximum width for the profile container */
        margin: auto; /* Center the container */
        padding: 20px; /* Add padding inside the container */
        border: 1px solid #eaeaea; /* Light gray border */
        border-radius: 10px; /* Rounded corners */
        background-color: #f9f9f9; /* Light background color */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .profile-info {
        display: flex; /* Use flexbox for layout */
        align-items: center; /* Center items vertically */
        margin-bottom: 20px; /* Space below the profile info */
    }

    .profile-image {
        margin-right: 20px; /* Space between image and details */
    }

    .profile-image img {
        border-radius: 50%; /* Make profile image circular */
        width: 100px; /* Set a width for the profile image */
        height: 100px; /* Set a height for the profile image */
    }

    .profile-details h2 {
        margin: 0; /* Remove margin from the heading */
        font-size: 24px; /* Set font size for name */
    }

    .profile-details p {
        margin: 5px 0; /* Space between paragraphs */
    }

    /* Centering the h1 element */
    .text-center {
        text-align: center; /* Center text */
        margin-bottom: 20px; /* Space below the heading */
    }

    /* Button Styles */
    .button-group {
        display: flex; /* Use flexbox for button alignment */
        justify-content: center; /* Center buttons horizontally */
        gap: 10px; /* Space between buttons */
    }

    .btn {
        border-radius: 5px; /* Rounded corners for buttons */
        padding: 10px 20px; /* Larger padding for a more clickable area */
        font-weight: bold; /* Bold text */
        font-size: 14px; /* Font size for the button */
        text-align: center; /* Center the button text */
        transition: background-color 0.3s ease, transform 0.2s; /* Smooth transitions */
    }

    .btn-primary {
        background-color: #6fa3ef; /* Muted blue for primary button */
        color: white; /* White text color */
        border: none; /* Remove border */
    }

    .btn-primary:hover {
        background-color: #5a92d1; /* Slightly darker shade on hover */
        transform: translateY(-2px); /* Lift effect on hover */
    }

    .btn-secondary {
        background-color: #c2c2c2; /* Muted gray for secondary button */
        color: #333; /* Dark text color for contrast */
        border: none; /* Remove border */
    }

    .btn-secondary:hover {
        background-color: #b3b3b3; /* Slightly darker gray on hover */
        transform: translateY(-2px); /* Lift effect on hover */
    }
    /* Uploaded Photos Section */
.uploaded-photos {
    margin-top: 30px; /* Space above the uploaded photos section */
}

.uploaded-photos h3 {
    font-size: 20px; /* Adjust the heading size */
    color: #333; /* Dark color for heading */
    text-align: center; /* Center the heading */
    margin-bottom: 20px; /* Space below the heading */
}

/* Card for Each Uploaded Photo */
.card {
    border: none; /* Remove card border */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transition: transform 0.2s ease, box-shadow 0.3s ease; /* Smooth transitions for hover effects */
}

.card:hover {
    transform: translateY(-5px); /* Slight lift effect on hover */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
}

.card-img-top {
    border-radius: 10px 10px 0 0; /* Rounded top corners for the image */
    height: 200px; /* Set a fixed height for the image */
    object-fit: cover; /* Ensure image fits within the card without distortion */
}

.card-body {
    padding: 15px; /* Padding inside the card body */
    background-color: #fff; /* White background for the card body */
}

.card-body p {
    margin: 0;
    font-size: 14px; /* Adjust font size for caption */
    color: #555; /* Darker color for caption */
}

.card-body small {
    display: block;
    margin-top: 10px; /* Space above the date */
    font-size: 12px; /* Small font for the date */
    color: #888; /* Muted color for date */
}

/* Row Layout for Photos */
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center the cards */
}

.col-md-4 {
    flex: 1 1 30%; /* Each card takes up about 30% of the row */
    max-width: 300px; /* Maximum width for each card */
    margin-bottom: 20px; /* Space below each card */
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 1 1 100%; /* Cards take up full width on smaller screens */
        max-width: 100%;
    }
}

</style>
