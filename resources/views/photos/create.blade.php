@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Pilih Foto</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="caption">Keterangan</label>
            <input type="text" name="caption" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Unggah</button>
    </form>

    <!-- Tombol Kembali ke Halaman Foto -->
    <div class="text-center mt-4">
        <a href="{{ route('photos.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

<style>
.container {
    margin-top: 20px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    color: #333;
}

input[type="file"],
input[type="text"] {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

input[type="file"] {
    padding: 5px;
}

input[type="text"]:focus,
input[type="file"]:focus {
    border-color: #0095f6;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 149, 246, 0.5);
}

.btn {
    border-radius: 5px;
    padding: 10px;
    font-weight: bold;
    color: white;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-primary {
    background-color: #28a745;
}

.btn-primary:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
}

</style>
