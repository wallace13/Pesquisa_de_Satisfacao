<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministrativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = DB::table('users')->where('deleted_at', null)->paginate(10);
        return view('administrativo.index', ['funcionarios' => $funcionarios]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = $this->regras();
        $feedback = $this->feedback();
        $request->validate($regras, $feedback);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nivelPermissao' => $request->nivelPermissao,
            'password' => Hash::make($request->password),
        ]);
        $id = $user->id;
        return redirect()->route('administrativo.show', $id);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('id','name','email','nivelPermissao','password')->where('id', $id)->first();
        return view('administrativo.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('administrativo.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $email = User::select('email')->where('id', $id)->first();
        $regraEmail = ($email->email == $request->email) ? "" : "unique:users" ;
        $feedbackEmail = ($email->email == $request->email) ? "" : "email.email' => 'O campo e-mail não foi preenchido corretamente" ;
    
        $regras = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $regraEmail],
            'nivelPermissao' => ['required']
        ];
        $feedback = [              
            'required' => 'O campo :attribute deve ser preenchido',
            'unique' => 'O E-mail informado já existe',
            'max' => 'O campo :attribute deve ter no máximo 255 caracteres',
            $feedbackEmail
        ];
        $request->validate($regras, $feedback);

        $user = User::where('id', $id)->update(['name' => $request->name,'email'=> $request->email,'nivelPermissao'=> $request->nivelPermissao]);
        return redirect()->route('administrativo.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->update(['deleted_at' => date("Y-m-d H:i:s")]);
        //DB::table('users')->where('id', $id)->delete();
        return redirect()->route('administrativo.index');
    }
    public function regras(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nivelPermissao' => ['required'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ];
    }

    public function feedback(){
        return [              
            'required' => 'O campo :attribute deve ser preenchido',
            'unique' => 'O E-mail informado já existe',
            'max' => 'O campo :attribute deve ter no máximo 255 caracteres',
            'password.min' => 'O campo senha deve ter no mínimo 4 caracteres',
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'email.email' => 'O campo e-mail não foi preenchido corretamente'
        ];
    }
}
