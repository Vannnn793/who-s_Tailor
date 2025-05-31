<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tailor;
use App\Models\TailorPhoto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TailorController extends Controller {

    public function edit() {
        $tailor = Tailor::where("user_id", Auth::user()->id)->first();
        $user = auth()->user();
        $tailor_photos = TailorPhoto::where('user_id', $user->id)->get();
        return view('edit', compact('user', 'tailor', 'tailor_photos'));
    }

    public function update(Request $request) {
        // dd();
            $data = $request->validate([
            'nama' => 'nullable|string',
            'umur'=> 'nullable|string',
            'skill' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'harga'=> 'nullable|string',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'pp'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();
        $tailor = Tailor::where('user_id', $user->id)->firstOrFail();
        $tailor->update(['nama' => $data['nama'],'umur'=>$data['umur'],'alamat' => $data['alamat'],"skill" => $data["skill"],"no_hp" => $data["no_hp"],"deskripsi" => $data["deskripsi"],'harga'=>$data['harga']]);
        User::where("id", $user->id)->update(["name" => $data["nama"]]);

        if($request->hasFile("pp")) {
        $pp = $request->file('pp');
        $newpath=$pp -> store('photos','public');

        User::where('id', $user->id)->update(['pp'=> $newpath]);
        }

        if ($request->hasFile('photo') ) {
        $photo = $request->file('photo');
        $path = $photo->store('photo', 'public'); // Simpan ke storage/app/public/photo


        $tailor = TailorPhoto::create([
            'user_id' => $user->id,
            'path' => $path
        ]);

        }

        return redirect  ()->route('update')->with('success', 'Profil berhasil diperbarui!');
    }

    public function showProfilePage() {
    //     $tailors = auth()->user();
    //     if (!$tailors) {
    //     // Jika tidak ditemukan, arahkan ke halaman edit (atau tampilkan view edit)
    //     return redirect()->route('profile', $tailors);
        
    // }

    $user  = Auth()->user();
    $tailor = Tailor::where('user_id', $user->id)->first();
    $tailor_photos = TailorPhoto::where('user_id', auth()->user()->id)->get();


    if(!$tailor || !$tailor_photos) {
        Tailor::create(['user_id'=> $user->id,"nama" => $user->name]);
    }
    // return view('test', compact('user','tailors','tailor_photos'));
    return view('profile', compact('user','tailor','tailor_photos'));

}  

    public function orders() {
        return view('tailor.orders');
    }

public function show($id)
{
    $tailor = Tailor::findOrFail($id);
    $user = $tailor->user; // akses user melalui relasi Tailor->user
    $tailor_photos = TailorPhoto::where('user_id', $tailor->user_id)->get();

    return view('show', compact('user', 'tailor', 'tailor_photos'));
}


}