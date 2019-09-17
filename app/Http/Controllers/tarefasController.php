<?php

namespace App\Http\Controllers;

use App\tarefa;
use Illuminate\Http\Request;
use App\Http\Requests\TarefaFormRequest;
use Illuminate\Support\Facades\Auth;

class tarefasController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
			return view('tarefas.create');
		}else{
			return redirect('home');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarefaFormRequest $request)
    {

		if(!(Auth::check())){
			return redirect('home');
		}

        $data = $request->validated();

        $count = \App\tarefa::count();

        $result = array_merge($data, array('ordem_apresentacao' => ($count + 1)));

        \App\tarefa::create($result);

        return redirect('home');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(tarefa $tarefa)
    {
		if(Auth::check()){
			return view('tarefas.edit', compact('tarefa'));
		}else{
			return redirect('home');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(TarefaFormRequest $request, tarefa $tarefa)
    {
		if(!(Auth::check())){
			return redirect('home');
		}

        $data = $request->validated();

        $tarefa->update($data);

        return redirect("/home");
    }

    public function trocaOrdem(Request $request)
    {
		if(!(Auth::check())){
			return redirect('home');
		}

		$antigo = $request->antigo +1;
		$novo = $request->novo +1;

		if($novo > $antigo){
			\App\tarefa::where('ordem_apresentacao', '=', $antigo)->update(['ordem_apresentacao' => 0]);
			\App\tarefa::where('ordem_apresentacao', '<=', $novo)->where('ordem_apresentacao', '>', $antigo)->decrement('ordem_apresentacao');
			\App\tarefa::where('ordem_apresentacao', '=', 0)->update(['ordem_apresentacao' => $novo]);
		}else{
			\App\tarefa::where('ordem_apresentacao', '=', $antigo)->update(['ordem_apresentacao' => 0]);
			\App\tarefa::where('ordem_apresentacao', '>=', $novo)->where('ordem_apresentacao', '<', $antigo)->increment('ordem_apresentacao');
			\App\tarefa::where('ordem_apresentacao', '=', 0)->update(['ordem_apresentacao' => $novo]);
		}

		return response("Sucesso", 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(tarefa $tarefa)
    {
		if(!(Auth::check())){
			return redirect('home');
		}

		return redirect('/home');

        \App\tarefa::where('ordem_apresentacao', '>', $tarefa->ordem_apresentacao )->decrement('ordem_apresentacao');

        $tarefa->delete();

        return redirect('/home');
    }
}
