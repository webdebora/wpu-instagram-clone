@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Foto Terbaru</h1>

        <!-- Create Button -->
        <div class="mb-3">
            <a href="{{ route('photos.create') }}" class="btn btn-primary">Upload New Photo</a>
        </div>

        <div class="row">
            @foreach ($photos as $photo)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" class="card-img-top">
                    <div class="card-body">
                        <p>{{ $photo->caption }}</p>
                        <small>Uploaded by {{ $photo->user->name }}</small>

                        <!-- Form for adding a comment -->
                        <form action="{{ route('comments.store', $photo->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment" class="form-control" placeholder="Add a comment" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Comment</button>
                        </form>

                        <!-- Display Comments -->
                        <div class="mt-3">
                            @foreach ($photo->comments as $comment)
                                <div class="comment">
                                    <small>{{ $comment->user->name }}: {{ $comment->comment }}</small>
                                </div>
                            @endforeach
                        </div>

                        <!-- Like / Unlike Button -->
                        @if ($photo->likes()->where('user_id', auth()->id())->exists())
                            <!-- Unlike Button -->
                            <form action="{{ route('photos.unlike', $photo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Unlike</button>
                            </form>
                        @else
                            <!-- Like Button -->
                            <form action="{{ route('photos.like', $photo->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Like</button>
                            </form>
                        @endif

                        <!-- Displaying the number of likes -->
                        <p>{{ $photo->likes()->count() }} Likes</p>

                        <div class="mt-3 edit-delete-buttons">
                            @if (Auth::user()->id === $photo->user_id)
                                <!-- Edit Button -->
                                <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-warning btn-edit">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $photos->links() }}
        </div>
    </div>
@endsection


<style>
.container {
    margin-top: 20px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Centers the cards horizontally */
}

.card {
    margin: 10px; /* Adds some space around each card */
    border: none; /* Remove border for a cleaner look */
    border-radius: 10px; /* Rounded corners */
    overflow: hidden;
    background-color: #fff;
    transition: box-shadow 0.3s ease;
    max-width: 300px; /* Sets a maximum width for the cards */
    flex: 1 1 30%; /* Allows cards to take up 30% of the row on larger screens */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

h1 {
    text-align: center; /* Center the header */
    margin-bottom: 20px; /* Space below the header */
    font-size: 28px; /* Font size for the header */
    color: #333; /* Dark text color */
}

.card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
}

.card-img-top {
    width: 100%;
    height: auto;
    border-radius: 10px 10px 0 0; /* Rounded top corners */
}

.card-body {
    padding: 15px;
}

.card-body p {
    margin: 0;
    font-size: 14px;
    color: #333;
}

.card-body small {
    display: block;
    margin-top: 5px;
    color: #888;
    font-size: 12px;
}

.form-group {
    margin: 10px 0;
}

input[type="text"] {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: calc(100% - 22px);
}

input[type="text"]:focus {
    border-color: #0095f6;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 149, 246, 0.5);
}

.btn {
    border-radius: 5px;
    padding: 8px 12px; /* Adjust padding for smaller buttons */
    font-weight: bold;
    font-size: 14px; /* Font size for buttons */
}

.btn-primary {
    background-color: #a0d3f2; /* Pastel blue for primary button */
    color: rgb(57, 40, 208); /* White text color */
    border: none; /* Remove border */
}

.btn-primary:hover {
    background-color: #a0d3f2; /* Pastel blue for primary button */ /* Darker shade on hover */
}

.btn-success {
    background-color: #b2e7b2; /* Pastel green for like button */
    color: hsl(122, 47%, 38%); /* White text */
    border: none; /* Remove border */
}

.btn-success:hover {
    background-color: #b2e7b2; /* Pastel green for like button */
}

.col-md-4 {
    flex: 1 1 auto; /* Allows flexibility in width */
    max-width: 300px; /* Set a fixed maximum width for each card */
}

@media (max-width: 768px) {
    .col-md-4 {
        flex: 1 1 100%; /* Stacks cards on smaller screens */
        max-width: 100%;
    }
}

.edit-delete-buttons {
    display: flex;
    justify-content: space-between; /* Space out edit and delete buttons */
    margin-top: 10px; /* Space above buttons */
}

.btn-edit, .btn-delete {
    flex: 1; /* Proportional button size */
    margin: 0 5px; /* Margin between buttons */
    height: 40px; /* Consistent button height */
    width: 100%; /* Button width fills available space */
    border: none; /* Remove default border */
    color: white; /* Button text color */
}

.btn-edit {
    background-color: #dac080; /* Pastel yellow for edit button */
    color: rgb(198, 106, 0); /* Button text color */
}

.btn-edit:hover {
    background-color: #dcbe72; /* Pastel yellow for edit button */
}

.btn-delete {
    background-color: #e85b5d; /* Pastel red for delete button */
}

.btn-delete:hover {
    background-color: #e85b5d; /* Pastel red for delete button */
}

</style>
