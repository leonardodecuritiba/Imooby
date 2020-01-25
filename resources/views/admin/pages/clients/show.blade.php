@extends('admin.layout.template')
@section('style_content')
    <!-- icheck -->
    {{--{!! Html::style('css/icheck/flat/green.css') !!}--}}
    <style>
        .select2 {
            width: 100%;
        }

        .preco {
            font-size: 13px;
            font-weight: 400;
            color: #26B99A;
        }
    </style>
@endsection
@section('page_content')
    <div class="x_panel">
        <div class="alert fade in alert-{{$Data->getStatusColor()}}" role="alert">
            Cliente {{$Data->getStatusText()}}
        </div>
        <div class="x_title">
            <h2>Cliente - {{$Data->name}} </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if($Data->getStatus())
                        <button class="btn btn-danger"
                                onclick="window.location.href='{{route('clients.disactivate',$Data->id)}}'">
                            <i class="fa fa-times fa-2" aria-hidden="true"></i> {{$Data->getStatusActionText()}}
                        </button>
                    @else
                        <button class="btn btn-success"
                                onclick="window.location.href='{{route('clients.activate',$Data->id)}}'">
                            <i class="fa fa-check fa-2" aria-hidden="true"></i> {{$Data->getStatusActionText()}}
                        </button>
                    @endif
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 profile_left">
                @include('admin.pages.'.$Page->link.'.panels.perfil')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs left" role="tablist">
                        <li role="presentation" @if($Page->tab == 'about') class="active" @endif>
                            <a href="#tab_about" role="tab" data-toggle="tab" aria-controls="perfil"
                               aria-expanded="true">Perfil</a>
                        </li>
                        <li role="presentation" @if($Page->tab == 'properties') class="active" @endif>
                            <a href="#tab_properties" role="tab" data-toggle="tab" aria-controls="properties"
                               aria-expanded="false">Imóveis</a>
                        </li>
                    </ul>
                    <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade @if($Page->tab == 'about') active in @endif"
                             id="tab_about" aria-labelledby="perfil-tab">
                            @include('admin.pages.'.$Page->link.'.panels.about')
                        </div>
                        <div role="tabpanel" class="tab-pane fade @if($Page->tab == 'properties') active in @endif"
                             id="tab_properties" aria-labelledby="properties-tab">
                            @include('admin.pages.'.$Page->link.'.panels.properties')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJV9VR2lJbWR4MB3bsv7mMvIXsEK9cc_w&callback=initMap">
    </script>
@endsection

