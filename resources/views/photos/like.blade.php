@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Foto yang Disukai</h1>
        <div class="row">
            @if ($likedPhotos->isEmpty())
                <div class="col-md-12">
                    <div class="alert alert-info">
                        Belum ada foto yang disukai.
                    </div>
                </div>
            @else
                @foreach ($likedPhotos as $photo)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $photo->image) }}" class="card-img-top">
                            <div class="card-body">
                                <p>{{ $photo->caption }}</p>
                                <small>Uploaded by {{ $photo->user->name }}</small>

                                <!-- Unlike Button -->
                                <form action="{{ route('photos.unlike', $photo->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Unlike ({{ $photo->likes_count }})
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $likedPhotos->links() }}
        </div>
    </div>
@endsection
