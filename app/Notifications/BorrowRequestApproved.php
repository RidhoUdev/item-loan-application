<?php

namespace App\Notifications;

use App\Models\BorrowRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BorrowRequestApproved extends Notification
{
    use Queueable;

    protected $borrowRequest;

    public function __construct(BorrowRequest $borrowRequest)
    {
        $this->borrowRequest = $borrowRequest;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'borrow_request_id' => $this->borrowRequest->id,
            'message'           => 'Permintaan peminjaman Anda telah disetujui!',
            'item_name'         => $this->borrowRequest->items->first()->name,
            'url'               => route('user.home'),
        ];
    }
}
