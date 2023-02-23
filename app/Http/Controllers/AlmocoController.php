<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almoco;
use App\Models\User;
use App\Models\VotacaoAlmoco;
use Illuminate\Support\Facades\DB;

class AlmocoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almocos = DB::table('almocos')->paginate(10);
        return view('almoco.index', ['almocos' => $almocos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almoco.create');
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

            $almoco = Almoco::create($request->all());
            $id = $almoco->id;
            VotacaoAlmoco::create([
                'otimo' => 0,
                'bom' => 0,
                'regular' => 0,
                'ruim' => 0,
                'almoco_id' => $id
            ]);
            $msg="Cadastro criado com sucesso!";
        }
        return redirect()->route('almoco.show', ['almoco' => $id])->with('msg', $msg);
    }
    public function verificaCadastro($data){
        $almoco = Almoco::select('id', 'data')->where('data', $data)->first();
        return $almoco;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Almoco $almoco)
    {
        $nome = User::select('name')->where('id', $almoco->user_id)->first();
        return view('almoco.show', ['almoco' => $almoco,'nome' => $nome]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Almoco $almoco)
    {
        return view('almoco.edit', ['almoco' => $almoco]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Almoco $almoco)
    {        
        $resultado = $this->verificaCadastro($request->data);

        $regras = $this->regras();
        $feedback = $this->feedback();
        $request->validate($regras, $feedback);

        if($request->data == $almoco->data){
            $almoco->update($request->all());
            $id = $almoco->id;
            $msg="Edição efetuada com sucesso!";
            $retorno = redirect()->route('almoco.show', ['almoco' => $id])->with('msg', $msg);  
        }else if(isset($resultado)){
            $id = $resultado->id;
            $msg="Já existe um cardápio nesta data!";
            $retorno = redirect()->route('almoco.edit', ['almoco' => $id])->with('msg', $msg);
        }else{
            $almoco->update($request->all());
            $id = $almoco->id;
            $msg="Edição efetuada com sucesso!";
            $retorno = redirect()->route('almoco.show', ['almoco' => $id])->with('msg', $msg);  
        }
        return $retorno;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almoco $almoco)
    {
        $teste = DB::table('votacaoalmocos')->where('almoco_id', $almoco->id)->delete();
        $almoco->delete();
        return redirect()->route('almoco.index');
    }

    public function regras(){
        return [
            'data' => 'required',
            'salada' => 'required',
            'complemento' => 'required',
            'principal' => 'required',
            'sobremesa' => 'required',
            'suco' => 'required',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute deve ser preenchido',
        ];
    }
}

