@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row col-sm-12 justify-content-center">
          <h1>Editar tarefa: "{{$tarefa->nome_tarefa}}"</h1>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header justi">{{ __('Formulário') }}</div>

                <div class="card-body">
                    <form method="POST" action="/tarefa/{{$tarefa->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="nome_tarefa" class="col-md-4 col-form-label text-md-right">{{ __('Nome da Tarefa') }}</label>

                            <div class="col-md-6">
                                <input id="nome_tarefa" type="text" class="form-control @error('nome_tarefa') is-invalid @enderror" name="nome_tarefa" value="{{ old('nome_tarefa') ?? $tarefa->nome_tarefa}}" autocomplete="nome_tarefa" autofocus>

                                @error('nome_tarefa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="custo" class="col-md-4 col-form-label text-md-right">{{ __('Custo') }}</label>

                            <div class="col-md-6">
                                <input id="custo" type="number" step="0.01" class="form-control @error('custo') is-invalid @enderror" name="custo" value="{{ old('custo') ?? $tarefa->custo}}" autocomplete="custo">

                                @error('custo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_limite" class="col-md-4 col-form-label text-md-right">{{ __('Data Limite') }}</label>

                            <div class="col-md-6">
                                <input id="data_limite" type="date" class="form-control" name="data_limite" value="{{ old('data_limite') ?? $tarefa->data_limite}}" autocomplete="data_limite">

                                @error('data_limite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
