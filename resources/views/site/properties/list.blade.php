@extends('site.layouts.map.template')

@section('body_content')


    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')
    <!-- Content -->
    <div id="wrapper" style="background-color: #eee;">
        <div class="container">
            <div class="sombra_total" style="background-color: #fff; margin-top: 20px; padding: 20px; margin-bottom: 20px;">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="h3title"><i class="fa fa-building"></i> <b>Lista de imóveis</b></label>
                    </div>
                    <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Endereço</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td><a href="{{ route('ver-imovel', ['id'=>$property->id]) }}">{{ $property->title }}</a></td>
                                <td>{{ $property->address->getFullAddress() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection