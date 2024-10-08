@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture (optional)</label>
                <input type="file" name="profile_picture" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection

<style>
    .container {
        max-width: 600px; /* Set a max width for the form container */
        margin: auto; /* Center the container */
        padding: 20px; /* Add padding inside the container */
        border: 1px solid #eaeaea; /* Light gray border */
        border-radius: 10px; /* Rounded corners */
        background-color: #f9f9f9; /* Light background color */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    h1 {
        margin-bottom: 20px; /* Space below the header */
        font-size: 28px; /* Header font size */
        color: #333; /* Dark text color */
    }

    .form-group {
        margin-bottom: 15px; /* Space between form groups */
    }

    label {
        font-weight: bold; /* Bold labels */
        margin-bottom: 5px; /* Space below labels */
        display: block; /* Make labels block-level elements */
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
        border: 1px solid #ccc; /* Default border color */
        border-radius: 5px; /* Rounded corners */
        padding: 10px; /* Inner padding */
        width: 100%; /* Full width */
        transition: border-color 0.3s; /* Transition for border color */
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="file"]:focus {
        border-color: #0095f6; /* Change border color on focus */
        outline: none; /* Remove default outline */
        box-shadow: 0 0 5px rgba(0, 149, 246, 0.5); /* Add shadow on focus */
    }

    .btn {
        border-radius: 5px; /* Rounded corners for buttons */
        padding: 8px 12px; /* Adjust padding for a smaller button */
        font-weight: bold; /* Bold text */
        width: auto; /* Auto width for smaller buttons */
        font-size: 14px; /* Smaller font size for the button */
    }

    .btn-primary {
        background-color: #0095f6; /* Primary button background color */
        color: white; /* White text color */
        border: none; /* Remove border */
    }

    .btn-primary:hover {
        background-color: #007bb5; /* Darker shade on hover */
    }

    .invalid-feedback {
        color: #dc3545; /* Red color for error messages */
        font-size: 14px; /* Font size for error messages */
    }
</style>
