<section class="row">
    {!! Form::open(['method' => 'PATCH',
        'route'=>[$Page->link.'.update',$Data->id],
        'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Cep: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="zip" type="text" class="form-control show-cep" value="{{$Data->address->zip}}"
                   required>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Estado: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="state" type="text" class="form-control" value="{{$Data->address->state}}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Cidade: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="city" type="text" class="form-control" value="{{$Data->address->city}}" required>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Bairro: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="district" type="text" class="form-control" value="{{$Data->address->district}}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Rua: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="street" type="text" class="form-control" value="{{$Data->address->street}}" required>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Número: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="number" type="text" class="form-control" value="{{$Data->address->number}}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Complemento: </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input name="complement" type="text" class="form-control" value="{{$Data->address->complement}}"
                   required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 ">
            <a href="{{route($Page->link.'.index')}}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 ">
            <button type="submit" class="btn btn-success btn-lg btn-block">Salvar</button>
        </div>
    </div>
    {{ Form::close() }}
</section>
<section class="row">
    <div id="map"><span class="fa fa-spin fa-spinner"></span> Carregando Mapa...</div>
</section>
<script>
    function initMap() {
        var ctba = {lat: -25.431016, lng: -49.2655};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: ctba
        });
        var marker = new google.maps.Marker({
            position: ctba,
            map: map
        });


        var lat = parseFloat('{{$Data->address->lat}}');
        var lng = parseFloat('{{$Data->address->lng}}');
        var marker = new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map
        });
    }
</script>