@extends('site.layouts.map.template')
@section('styles_content')
<style type="text/css">
.container-width {

}
</style>
@endsection
@section('body_content')
@include('site.layouts.menu.navbar')

    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')
    <!-- Content -->
    <div id="wrapper">
    <div class="container">
    <div class="card" style="background-color: #fff;cursor:auto; margin-top: 20px; padding: 20px; margin-bottom: 20px;">
    <div class="row">
    <div class="col-md-6">
    <div class="row card" style="margin-right:15px;cursor:auto;">
    <div class="col-xs-3">
    	<img src="{{ $property->getThumbMainPhoto() }}" style="opacity: 1;max-width:100%;max-height:100%;">
    </div>
    <div class="col-xs-9">
    <h4>{{ $property->title }}</h4>
    	<span class="text-muted"><span class="icon-pointer"></span> {{ $property->address->getFullAddress() }}</span>
    </div>
    </div>
    <h4>Datas disponíveis para visita</h4>
    <table class="table table-hover">
    	<thead>
    		<tr>
    			<th>Data:</th>
    			<th>Horário:</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
        @if(count($schedules)>0)
        @foreach($schedules as $schedule)
    		<tr>
    			<td>{{ $schedule->formatedDate() }}</td>
    			<td>{{ $schedule->formatedFrom() }} até às {{ $schedule->formatedTo() }}</td>
    			<td><a href="#" data-text="{{ $schedule->formatedDate() }} - {{ $schedule->formatedFrom() }} até às {{ $schedule->formatedTo() }}" data-url="{{ route('scheduler.remove', ['pid'=>$property->id, 'sid'=>$schedule->id]) }}" class="delete-schedule"><i class="fa fa-trash"></i></a></td>
    		</tr>
        @endforeach
        @else
            <tr>
            <td colspan="3">Nenhuma data disponível para visita.</td>
            </tr>
        @endif
    	</tbody>
    </table>
    {{ $schedules->links() }}
    </div>
    <div class="col-md-6">
<form method="POST" role="form" action="{{ route('scheduler.add') }}">
{{ csrf_field() }}
<input type="hidden" name="property_id" value="{{ $property->id }}">
	<legend>Adicionar datas disponíveis para visitas:</legend>
	<h4>Selecione os dias:</h4>
	<div id="datemulti"></div>
    <input type="hidden" id="dates" name="dates">
	<h4>Selecione o horário disponível nos dias selecionados acima:</h4>
	<div class="row">
	<div class="col-sm-6">
	<div class="form-group">
		<label for="">Das:</label>
		<input type="text" class="form-control clockpicker" value="{{ (old('from', null) == null ? '07:00' : old('')) }}" name="from">
	</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
		<label for="">Até as:</label>
		<input type="text" class="form-control clockpicker" value="{{ (old('from', null) == null ? '11:00' : old('')) }}" name="to">
		</div>
	</div>
	

	<button type="submit" class="btn btn-primary">Adicionar disponibilidade</button>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('scripts_content')
<script>
$(document).ready(function(){
	$( ".delete-schedule" ).click(function(){
        var delUrl = $(this).attr('data-url');
        var dText = $(this).attr('data-text');
		$.confirm({
            title: 'Excluir horário',
            content: 'Tem certeza que deseja excluir o horário de agendamento de '+dText+'?',
            buttons: {
                confirm: {
                    text: 'Confirmar',
                    btnClass: 'btn btn-info',
                    keys: ['enter', 'shift'],
                    action: function() {
                        window.location.href = delUrl;
                    }
                },
                cancel: {
                    text: 'Cancelar'
                }
            }
        });
	});
	$('#datemulti').datepicker({
	language: 'pt-BR',
    multidate: true,
    startDate: 'today'
	});
    $('#datemulti').on('changeDate', function() {
    $('#dates').val(
        $('#datemulti').datepicker('getFormattedDate')
    );
});
	$('.clockpicker').timepicker({timeFormat:"H:i",forceRoundTime:true});
});
</script>
@endsection