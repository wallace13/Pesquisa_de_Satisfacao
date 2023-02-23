<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;
use App\Models\User;
use App\Models\VotacaoCafe;
use Illuminate\Support\Facades\DB;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cafes = DB::table('cafes')->paginate(10);
        return view('cafe.index', ['cafes' => $cafes]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cafe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resultado = $this->verificaCadastro($request->data);
        if(isset($resultado)){
            $msg="Cadastro existente!";
            $id = $resultado->id;
        }else{
            $regras = $this->regras();
            $feedback = $this->feedback();
            $request->validate($regras, $feedback);
            $request['user_id'] = auth()->user()->id;

            $cafe = Cafe::create($request->all());
            $id = $cafe->id;

            VotacaoCafe::create([
                'otimo' => 0,
                'bom' => 0,
                'regular' => 0,
                'ruim' => 0,
                'cafe_id' => $id
            ]);
            $msg="Cadastro criado com sucesso!";
        }

        return redirect()->route('cafe.show', ['cafe' => $id])->with('msg', $msg);
    }
    public function verificaCadastro($data){
        $cafe = Cafe::select('id', 'data')->where('data', $data)->first();
        return $cafe;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cafe $cafe)
    {
        $nome = User::select('name')->where('id', $cafe->user_id)->first();
        return view('cafe.show', ['cafe' => $cafe,'nome' => $nome]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function edit(Cafe $cafe)
    {
        return view('cafe.edit', ['cafe' => $cafe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cafe $cafe)
    {
        $resultado = $this->verificaCadastro($request->data);

        $regras = $this->regras();
        $feedback = $this->feedback();
        $request->validate($regras, $feedback);
        
        if($request->data == $cafe->data){
            $cafe->update($request->all());
            $id = $cafe->id;
            $msg="Edição efetuada com sucesso!";
            $retorno = redirect()->route('cafe.show', ['cafe' => $id])->with('msg', $msg);
        }else if(isset($resultado)){
            $id = $resultado->id;
            $msg="Já existe um cardápio nesta data!";
            $retorno = redirect()->route('cafe.edit', ['cafe' => $id])->with('msg', $msg);
        }else{
            $cafe->update($request->all());
            $id = $cafe->id;
            $msg="Edição efetuada com sucesso!";
            $retorno = redirect()->route('cafe.show', ['cafe' => $id])->with('msg', $msg);
        }
        return $retorno;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cafe $cafe)
    {
        $teste = DB::table('votacaocafes')->where('cafe_id', $cafe->id)->delete();
        $cafe->delete();
        return redirect()->route('cafe.index');
    }
    public function regras(){
        return [
            'data' => 'required',
            'principal' => 'required',
            'opcao' => 'required',
        ];
    }

    public function feedback(){
        return [              
            'required' => 'O campo :attribute deve ser preenchido',
        ];
    }
}
