<?php
namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('user')->latest()->paginate(9); // Mengambil foto dengan relasi user
        return view('photos.index', compact('photos')); // Mengirimkan variabel $photos ke view
    }

    public function create()
    {
        return view('photos.create');
    }
    public function addComment(Request $request, $photoId)
{
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Menyimpan komentar ke database
    $photo = Photo::findOrFail($photoId);
    $photo->comments()->create([
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);

    return redirect()->route('photos.index')->with('success', 'Comment added successfully!');
}

public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'caption' => 'required|string|max:255',
    ]);

    if ($request->hasFile('image')) {
        // Store the image in the 'photos' directory inside the storage/public folder
        $imagePath = $request->file('image')->store('photos', 'public');

        // Save photo details to the database
        $photo = new Photo();
        $photo->image_path = $imagePath;
        $photo->caption = $request->caption;
        $photo->user_id = auth()->id(); // Assuming you are tracking the user who uploaded the photo
        $photo->save();

        // Redirect with success message
        return redirect()->route('photos.index')->with('success', 'Foto berhasil diunggah!');
    }

    // If the image wasn't uploaded, return back with an error message
    return back()->with('error', 'Gagal mengunggah foto.');
}

    public function edit(Photo $photo)
    {
        $this->authorize('update', $photo);
        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:255',
        ]);

        $photo = Photo::findOrFail($id);

        // Periksa jika ada file baru yang diupload
        if ($request->hasFile('image')) {
            // Hapus file lama dari storage jika ada
            if ($photo->image_path) {
                Storage::delete($photo->image_path);
            }

            // Simpan file baru dan update path di database
            $path = $request->file('image')->store('photos');
            $photo->image_path = $path;
        }

        // Update caption
        $photo->caption = $request->caption;
        $photo->save();

        return redirect()->route('photos.index')->with('success', 'Foto berhasil diupdate.');
    }



     public function like($photoId)
{
    $photo = Photo::findOrFail($photoId);

    // Cek apakah user sudah menyukai foto ini
    if (!$photo->likes()->where('user_id', auth()->id())->exists()) {
        $photo->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('photos.index')->with('success', 'Foto berhasil disukai!');
    }

    return redirect()->route('photos.index')->with('error', 'Anda sudah menyukai foto ini.');
}

public function unlike($photoId)
{
    $photo = Photo::findOrFail($photoId);

    // Temukan like yang ada
    $like = $photo->likes()->where('user_id', auth()->id())->first();

    if ($like) {
        $like->delete();
        return redirect()->route('photos.index')->with('success', 'Like dibatalkan.');
    }

    return redirect()->route('photos.index')->with('error', 'Anda belum menyukai foto ini.');
}

public function destroy($id)
{
    $photo = Photo::findOrFail($id); // Find the photo by ID
    $this->authorize('delete', $photo); // Check if the user can delete this photo

    // Delete the image file from storage
    Storage::delete('public/' . $photo->image_path);

    // Delete the photo record from the database
    $photo->delete();

    return redirect()->route('photos.index')->with('success', 'Foto berhasil dihapus!');
}

public function profile()
{
    // Logika untuk mengambil data profil
    return view('photos.profile'); // Ganti dengan view yang sesuai
}
}
