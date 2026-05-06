<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request){

        $rules = [
            'text_username' => ['required', 'email'],
            'text_password' => ['required', 'min:8']
        ];

        $messages = [
            'text_username.required' => 'O campo username é obrigatório.',
            'text_username.email' => 'O campo username deve ser um email válido.',
            'text_password.required' => 'O campo password é obrigatório.',
            'text_password.min' => 'O campo password deve ter pelo menos :min caracteres.'
        ];

        //form validation
        $request->validate($rules, $messages);

        $username = $request->input('text_username');
        $password = $request->input('text_password');


        // Check if user exists
        $user = User::where('username', $username)
                    ->where('deleted_at', NULL)
                    ->first();

        if (!$user) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Usuário ou senha não encontrado.');
        }

        // Check if password is correct
        if(!password_verify($password, $user->password)) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Usuário ou senha não encontrado.');
        }

        // Update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // Login user
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]

        ]);

        return redirect()->to('/');

    }

    public function logout()
    {
        // LogOut from the application
        session()->forget('user');

        return redirect()->to('/login');
    }

}
