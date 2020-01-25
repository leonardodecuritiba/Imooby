@extends('admin.layout.template')
@section('title', 'Home')
@section('page_content')
    <div class="x_panel">
        <div class="x_content">
            <div class="row jumbotron">
                <h1>Bem Vindo,</h1>
                <h2>{{Auth::user()->admin->name}}</h2>
            </div>
        </div>
    </div>
@endsection