@extends('site.layouts.map.template')
@section('styles_content')
<style type="text/css">
    .modal-header {
        border-bottom: none;
    }

    .modal-footer {
        background-color: #00a7ec;
    }

    .modal-content {
        border-radius: 0px;
    }

    .modal-body {
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;
    }
    .rightContainer {
        line-height: 2em;
        background: white;
        padding: 55px;
    }
    .rightContainer h1 {
        font-size: 1.5em !important;
    }
</style>
@endsection
@section('body_content')

	<!-- Bar Navigation -->
	@include('site.layouts.menu.navbar')

	<!-- Left Side Navigation -->
	@include('site.layouts.menu.sidebar')

	<!-- Content -->
	<div id="wrapper">

	    <div class="container">
	        <div class="sombra_total"
	            style="background-color: #fff; margin-top: 20px; padding: 20px; margin-bottom: 20px;"
	        >
	        	<h1>Trocar capa</h1>
	        	<p>Por favor, selecione abaixo a imagem de capa para o anúncio do seu ímovel:</p>
	            {!! Form::open(['route' => ['property.change_cover', $_SELF_TEMPLATE_['Property']->id], 'method' => 'POST',
	                'role' => 'form']) !!}
	                <div class="row">
					    @foreach($_SELF_TEMPLATE_['Property']->properties_photo as $key => $photo)
					    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						    	<div class="panel panel-default" style="border-radius: 0px;">
								    <div class="panel-body text-center" style="padding: 0px; max-height: 320px; min-height: 320px">
										<img src="{{$photo->getPhoto()}}" alt="First slide"  style="margin: auto; max-width: 100%; max-height: 320px; min-height: 320px" >
								    </div>
								    <div class="panel-footer text-center">
								    	@if($_SELF_TEMPLATE_['Property']->cover)
									    	@if($_SELF_TEMPLATE_['Property']->cover->idphoto != $photo->photo->id)
										    	<a href="{{route('property.change_cover_action',[$_SELF_TEMPLATE_['Property']->id, $photo->photo->id])}}" class="btn btn-success btn-xs" style="border-radius: 0px;"><i
		                                        class="fa fa-image"></i> Transformar em capa</a>
		                                    @else
		                                    	<span class="text-success">
		                                    		Já é a capa atual!
		                                    	</span>
		                                    @endif
		                                @else
		                                	<a href="{{route('property.change_cover_action',[$_SELF_TEMPLATE_['Property']->id, $photo->photo->id])}}" class="btn btn-success btn-xs" style="border-radius: 0px;"><i
		                                        class="fa fa-image"></i> Transformar em capa</a>
		                                @endif
								    </div>
								</div>
							</div>
                        @endforeach
					</div>
	           {{Form::close()}}
	       	</div>
	    </div>
	</div>
@endsection
    @section('scripts_content')

@if(!Auth::check() || !Auth::user()->hasRole('client'))
	@include('site.layouts.alerts.danger')
	<script type="text/javascript">
	    $(document).ready(function () {
	        $('#modal_danger').find('div.conteudo_modal ul').html('<li class="li_branco">Você precisa estar logado para anunciar um imóvel!</li>')
	        $('#modal_danger').modal('show');
	    })
	</script>
@endif
@endsection