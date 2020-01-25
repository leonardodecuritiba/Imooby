@extends('admin.layout.template')
@section('page_content')
    <!-- Seach form -->
    @include('admin.layout.search.form')
    <!-- Upmenu form -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{trans('pages.view.CREATE',['name' => $Page->Target])}}</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        @if(Route::currentRouteNamed($Page->link.'.create'))
            {!! Form::open(['route' => $Page->link.'.store',
                'files' => true,
                'method' => 'POST',
                'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
        @else
            {!! Form::open(['method' => 'PATCH',
                'files' => true,
                'route'=>[$Page->link.'.update',$Data->id],
                'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
        @endif

        <section class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{trans('pages.view.DATA')}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-horizontal form-label-left">
                            @include('admin.pages.'.$Page->link.'.forms.form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="form-horizontal form-label-left">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <a href="{{route($Page->link.'.index')}}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Salvar</button>
                    </div>
                </div>
            </div>
        </section>
        {{ Form::close() }}

    </div>
    {{--<!-- /page content -->--}}

@endsection
@section('scripts_content')

@endsection