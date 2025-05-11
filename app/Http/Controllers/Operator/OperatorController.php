<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;

class OperatorController extends Controller
{
    public function dashboard()
    {
        $pendingRequestsCount = BorrowRequest::where('status', 'pending')->count();

        $notReturnedItemsCount = BorrowRequest::whereIn('status', ['approved', 'borrowed'])->count();

        $returnedItemsCount = BorrowRequest::where('status', 'returned')->count();

        return view('operator.dashboard', compact(
            'pendingRequestsCount',
            'notReturnedItemsCount',
            'returnedItemsCount'
        ));
    }
}
