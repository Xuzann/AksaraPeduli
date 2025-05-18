<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function uploadProfileImage(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        if (!$request->hasFile('profileUpload') || !$request->file('profileUpload')->isValid()) {
            return response()->json(['success' => false, 'error' => 'File upload error'], 400);
        }

        $file = $request->file('profileUpload');

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return response()->json(['success' => false, 'error' => 'Hanya file JPG, PNG, atau GIF yang diperbolehkan'], 400);
        }

        if ($file->getSize() > 2097152) {
            return response()->json(['success' => false, 'error' => 'Ukuran file maksimal 2MB'], 400);
        }

        $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
        $uploadDir = public_path('uploads/profile_pictures');

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $file->move($uploadDir, $filename);

        $userId = $request->session()->get('user_id');

        // Update DB
        \DB::table('users')
            ->where('user_id', $userId)
            ->update(['profile_picture' => $filename]);

        return response()->json([
            'success' => true,
            'imageUrl' => route('profile.image', ['user_id' => $userId]),
        ]);
    }

    public function getProfileImage($user_id)
    {
        $user = \DB::table('users')->where('user_id', $user_id)->first();

        if (!$user || !$user->profile_picture) {
            return response()->json(['success' => false, 'error' => 'Gambar tidak ditemukan'], 404);
        }

        $imagePath = public_path('uploads/profile_pictures/' . $user->profile_picture);

        if (!file_exists($imagePath)) {
            return response()->json(['success' => false, 'error' => 'File tidak ada di server'], 404);
        }

        return response()->file($imagePath); // atau gunakan response()->download(...) jika ingin paksa unduh
    }
}
