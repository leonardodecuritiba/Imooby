@extends('layouts.template')
@section('page_content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$Page->titulo_primario}}</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <section class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Dados do {{$Page->Target}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-horizontal form-label-left">
                            @include('admin.'.$Page->link.'.form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {!! Form::open(['route' => [$Page->link.'.responder',$Contato->id],
            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
        <section class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Responder à {{$Contato->nome}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Mensagem: <span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea class="form-control" rows="8" name="mensagem" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 ">
                    <a href="{{route($Page->link.'.index')}}" class="btn btn-danger btn-lg btn-block">Voltar</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 ">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-send"></i> Enviar
                    </button>
                </div>
            </div>
        </section>
        {{ Form::close() }}
    </div>
    </div>
@endsection