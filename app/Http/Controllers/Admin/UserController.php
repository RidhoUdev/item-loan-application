<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\UserStoreFormRequest;
use App\Http\Requests\Admin\UserUpdateFormRequest;


class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserStoreFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        User::create($validatedData);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        return abort(404);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserUpdateFormRequest $request, User $user)
    {
        $validatedData = $request->validated();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
             return redirect()->route('admin.users.index')
                         ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // if ($user->role === 'admin') {
        //     return redirect()->route('admin.users.index')
        //                  ->with('error', 'Akun Admin tidak dapat dihapus.');
        // }

        try {
            $user->delete();
            return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
             return redirect()->route('admin.users.index')
                         ->with('error', 'Gagal menghapus user. Error: ' . $e->getMessage());
        }
    }
}
