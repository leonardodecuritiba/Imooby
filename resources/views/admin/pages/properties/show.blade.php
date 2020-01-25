@extends('admin.layout.template')
@section('style_content')
    <style>
        #map {
            height: 600px;
            width: 100%;
        }

    </style>
    <style>
        .file-preview-image-edit {
            margin: 5px !important;
            width: 100px;
        }

        .img-pos {
            display: inline-block;
            position: relative;
        }

        .image-remove {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 100;
        }
    </style>
@endsection
@section('modal_content')
    @include('admin.layout.modals.exclusao')
@endsection
@section('page_content')
    <div class="x_panel">
        <div class="alert fade in alert-{{$Data->getStatusColor()}}" role="alert">
            Imóvel {{$Data->getStatusText()}}
        </div>
        <div class="x_title">
            <h2>(#{{$Data->id}}) Imóvel - {{$Data->title}}
                <small>Proprietário: <b><a target="_blank"
                                           href="{{route('clients.show',$Data->owner->id)}}">{{$Data->owner->name}}</a></b>
                </small>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if($Data->status)
                        <button class="btn btn-danger"
                                onclick="window.location.href='{{route('properties.disactivate',$Data->id)}}'">
                            <i class="fa fa-times fa-2" aria-hidden="true"></i> {{$Data->getStatusActionText()}}
                        </button>
                    @else
                        <button class="btn btn-success"
                                onclick="window.location.href='{{route('properties.activate',$Data->id)}}'">
                            <i class="fa fa-check fa-2" aria-hidden="true"></i> {{$Data->getStatusActionText()}}
                        </button>
                    @endif
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" @if($Page->tab == 'profile') class="active in" @endif><a href="#profile"
                                                                                                     role="tab"
                                                                                                     data-toggle="tab"
                                                                                                     aria-expanded="true">Principal</a>
                    </li>
                    <li role="presentation" @if($Page->tab == 'photos') class="active in" @endif><a href="#photos"
                                                                                                    role="tab"
                                                                                                    data-toggle="tab"
                                                                                                    aria-expanded="false">Fotos</a>
                    </li>
                    <li role="presentation" @if($Page->tab == 'address') class="active in" @endif><a href="#address"
                                                                                                     role="tab"
                                                                                                     data-toggle="tab"
                                                                                                     aria-expanded="false">Endereço</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane @if($Page->tab == 'profile') active @endif" id="profile">
                        @include('admin.pages.properties.panels.profile')
                    </div>
                    <div class="tab-pane @if($Page->tab == 'photos') active @endif" id="photos">
                        @include('admin.pages.properties.panels.photos')
                    </div>
                    <div class="tab-pane @if($Page->tab == 'address') active @endif" id="address">
                        @include('admin.pages.properties.panels.address')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
    <script>
        jQuery(document).ready(function ($) {
            $('#myCarousel').carousel({
                interval: 5000
            });
        });
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJV9VR2lJbWR4MB3bsv7mMvIXsEK9cc_w&callback=initMap">
    </script>
@endsection

