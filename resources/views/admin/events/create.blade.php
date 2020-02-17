@extends('layouts.app')
@section('title', 'New Event')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<ol class="breadcrumb">
					<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
					<li><a href="{{ route('admin.events.index') }}">Eventos</a></li>
					<li class="active">{{ $title_page }}</li>
				</ol>

				<hr>

			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-danger">
						<ul>
							{{session('message')}}
						</ul>
                    </div>
                @endif
            </div>
        </div>

		<div class="row">
			<div class="col-md-12">
				<form action="{{ route($action) }}" method="post">
					<input type="hidden" name="user_id" value="1">
					@if (isset($event->id))
						<input type="hidden" name="id" value="{{ Auth::user()->id }}">
					@endif
					{{ csrf_field() }}
					@include('admin.events._form')
				</form>
			</div>
		</div>
	</div>
@endsection