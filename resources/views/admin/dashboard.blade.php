@extends('layouts.app')
@section('title', 'Home')

@section('content')    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="admin">Home</a></li>
				</ol>

                <hr>
                
                <a href="{{ route('admin.events.index') }}" class="btn btn-info pull-right" style="margin-bottom:20px;">Eventos</a>
            </div>
        </div>
	</div>
@endsection