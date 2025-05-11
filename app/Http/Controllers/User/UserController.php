<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function myRequests()
    {
        $userId = Auth::id();

        $borrowRequests = BorrowRequest::where('borrower_id', $userId)
                                       ->with(['items', 'operator'])
                                       ->latest('request_date')
                                       ->paginate(10);

        return view('user.pending', compact('borrowRequests'));
    }
}
