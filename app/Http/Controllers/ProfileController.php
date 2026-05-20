<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil statistik nyata berdasarkan relasi 'orders' (foreign key: created_by)
        $totalOrders = $user->orders()->count();
        $completedOrders = $user->orders()->where('status', 'selesai')->count();
        
        // Statistik khusus untuk bulan ini
        $ordersThisMonth = $user->orders()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Menghitung persentase penyelesaian secara dinamis
        $completionRate = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100) : 0;
        
        // Metrik performa (Dapat dikembangkan lebih lanjut di masa depan)
        $satisfaction = $totalOrders > 0 ? 98 : 0;
        $systemAccuracy = 95;

        return view('profile.index', compact(
            'user', 
            'totalOrders', 
            'completionRate', 
            'ordersThisMonth',
            'satisfaction', 
            'systemAccuracy'
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        // Pastikan Anda membuat file resources/views/profile/edit.blade.php jika ingin menggunakannya
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateDutyStatus(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'is_on_duty' => ['required', 'boolean'],
        ]);

        $user->is_on_duty = (bool) $request->is_on_duty;
        $user->save();

        return response()->json([
            'success' => true,
            'is_on_duty' => $user->is_on_duty,
            'message' => 'Status kerja berhasil diperbarui!'
        ]);
    }

    public function updateQuickNotes(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'quick_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->quick_notes = $request->quick_notes;
        $user->save();

        return response()->json([
            'success' => true,
            'quick_notes' => $user->quick_notes,
            'message' => 'Catatan berhasil disimpan!'
        ]);
    }
}