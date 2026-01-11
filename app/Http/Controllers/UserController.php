<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller

{

    use AuthorizesRequests;

    public function index()

    {   
        


        $users = User::paginate(10);
        return view('user_data.index', compact('users'));
    }

    public function create(Request $request, User $user)
    {
        $this->authorize('create', $user);

        return view('user_data.create');
    }

    public function store(Request $request)
{

    

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string', // Hapus min:8 jika ingin email pendek bisa jadi password
        'role' => 'required|in:pegawai,admin,pemilik'
    ]);
    
    $data['password'] = Hash::make($request->password); 
    User::create($data);
    
    // Sesuaikan redirect ke 'users.index'
    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
}
    public function update(Request $request, User $user) {}

    public function destroy(User $user) {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
        
    }
}
