@extends('layouts.app')
@section('title', 'New Event')

@section('content')    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{ env('APP_URL') }}/admin">Home</a></li>
					<li><a href="{{ route('admin.events.index') }}">Eventos</a></li>
				</ol>

                <hr>
                
                <a href="{{ route('admin.events.create') }}" class="btn btn-info pull-right" style="margin-bottom:20px;">Cadastrar evento</a>
            </div>
        </div>
        
        <div class="row">
			<div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-{{ session('class') }}">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
        
        <div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th width="35%">Título</th>
                            <th width="35%">Descrição</th>
                            <th width="15%">Dt Início</th>
                            <th width="15%">Dt Término</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($events as $event)

                            <tr>
                                <td>
                                    {{ $event->title }}
                                    <div class="pull-right">
                                        <a href="{{ route('admin.events.edit', $event->id) }}">Editar</a>
                                        <a href="{{ route('admin.events.delete', $event->id) }}">Remover</a>
                                    </div>
                                </td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->date_start }}</td>
                                <td>{{ $event->date_end }}</td>
                            </tr>

                        @endforeach

                    </tbody>
				</form>
			</div>
		</div>
	</div>
@endsection