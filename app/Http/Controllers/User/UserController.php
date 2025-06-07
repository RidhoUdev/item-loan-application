<?php

namespace App\Http\Controllers\User;

use App\Models\BorrowRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function homepage()
    {
        $user = Auth::user();

        $activeBorrowsCount = BorrowRequest::where('borrower_id', $user->id)
                                           ->whereIn('status', ['approved', 'borrowed'])
                                           ->count();

        $lastBorrowRequests = BorrowRequest::where('borrower_id', $user->id)
                                          ->with('items')
                                          ->latest('request_date')
                                          ->take(2)
                                          ->get();

        return view('user.home.homepage', compact(
            'user',
            'activeBorrowsCount',
            'lastBorrowRequests'
        ));
    }

    public function myRequests()
    {
        $userId = Auth::id();

        $borrowRequests = BorrowRequest::where('borrower_id', $userId)
                                       ->with(['items', 'operator'])
                                       ->latest('request_date')
                                       ->paginate(7);

        return view('user.pending', compact('borrowRequests'));
    }
}
