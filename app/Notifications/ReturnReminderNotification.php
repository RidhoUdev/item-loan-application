<?php

namespace App\Notifications;

use App\Models\BorrowRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReturnReminderNotification extends Notification
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
            'message' => 'Pengingat: Batas waktu pengembalian barang Anda akan segera berakhir.',
            'item_name' => $this->borrowRequest->items->first()->name,
            'due_date' => $this->borrowRequest->expected_return_date->format('d M Y'),
            'url' => route('user.home'),
        ];
    }
}
