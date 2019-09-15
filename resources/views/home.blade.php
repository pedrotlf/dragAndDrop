@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex card-header">
                    <h2>TAREFAS</h2>
                    <a href="tarefa/create" class="ml-auto"><button  class="btn btn-primary ">Adicionar</button></a>
                </div>

                <table-draggable :tarefa="{{ $tarefas }}"></table-draggable>

            </div>

        </div>
		
    </div>
</div>

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@endsection


