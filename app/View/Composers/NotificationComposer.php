<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Hanya jalankan jika user sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Ambil 5 notifikasi terbaru yang belum dibaca
            $unreadNotifications = $user->unreadNotifications()->latest()->take(5)->get();
            
            // Hitung semua notifikasi yang belum dibaca
            $unreadNotificationsCount = $user->unreadNotifications()->count();

            // Kirim variabel ke view
            $view->with(compact('unreadNotifications', 'unreadNotificationsCount'));
        }
    }
}