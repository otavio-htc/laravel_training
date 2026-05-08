<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class MainController extends Controller
{

    public function index()
    {

        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();

        return view('home', ['notes' => $notes]);
        
    }

    public function newNote()
    {

        echo "I'm new note page";

    }

    public function editarNota($id)
    {

        try{

            $id = Crypt::decrypt($id);

        } catch (DecryptException $e) {
            
            return redirect()->route('home')->with('error', 'ID inválido para edição.');

        }

        echo "Eu estou editando a nota com ID: " . $id;

    }

}
