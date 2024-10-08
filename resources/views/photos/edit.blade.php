@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="image">Gambar Saat Ini</label>
                <div>
                    <img src="{{ asset('storage/' . $photo->image_path) }}" class="img-thumbnail" width="300px">

                </div>
            </div>

            <div class="form-group">
                <label for="image">Ubah Gambar (Opsional)</label>
                <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror">
                @error('image_path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="caption">Caption</label>
                <textarea name="caption" class="form-control @error('caption') is-invalid @enderror">{{ old('caption', $photo->caption) }}</textarea>
                @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
<style>
.container {
    margin-top: 10px;
    display: flex; /* Menggunakan flexbox untuk menengah secara horizontal dan vertikal */
    justify-content: center; /* Menengahkan konten secara horizontal */
    align-items: center; /* Menengahkan konten secara vertikal */
    height: calc(100vh - 40px); /* Mengatur tinggi kontainer untuk sentralisasi */
}

form {
    width: 100%; /* Mengatur lebar form agar responsif */
    max-width: 500px; /* Mengatur lebar maksimum form */
    padding: 20px; /* Menambahkan padding dalam form */
    border: 1px solid #eaeaea; /* Menambahkan border pada form */
    border-radius: 10px; /* Sudut bulat pada form */
    background-color: #f9f9f9; /* Warna latar belakang form */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan pada form */
}



.form-group {
    margin-bottom: 15px; /* Menambahkan jarak antar grup form */
}

label {
    font-weight: bold; /* Membuat label lebih tebal */
}

input[type="file"], textarea, .form-control {
    border: 1px solid #ccc; /* Warna border default */
    border-radius: 5px; /* Sudut bulat */
    padding: 10px; /* Ruang dalam elemen */
    width: 100%; /* Lebar penuh */
    transition: border-color 0.3s; /* Transisi untuk perubahan warna border */
}

input[type="file"]:focus, textarea:focus, .form-control:focus {
    border-color: #0095f6; /* Warna border saat fokus */
    outline: none; /* Menghilangkan outline default */
    box-shadow: 0 0 5px rgba(0, 149, 246, 0.5); /* Efek bayangan saat fokus */
}

.invalid-feedback {
    color: #dc3545; /* Warna merah untuk pesan error */
    font-size: 14px; /* Ukuran font pesan error */
}

.btn {
    border-radius: 1px; /* Sudut bulat untuk tombol */
    padding: 8px; /* Ruang dalam tombol */
    font-weight: bold; /* Tebal untuk teks tombol */
    width: 50%; /* Lebar penuh */
}

.btn-primary {
    background-color: #0095f6; /* Warna tombol primer */

    border: none; /* Menghilangkan border default */
}

.btn-primary:hover {
    background-color: #007bb5; /* Warna saat hover */
}

.img-thumbnail {
    border-radius: 5px; /* Sudut bulat pada gambar */
    margin-bottom: 15px; /* Jarak bawah untuk gambar */
}



</style>
