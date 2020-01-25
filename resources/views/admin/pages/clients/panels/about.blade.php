<section class="row">
    <div class="x_panel">
        <div class="x_title">
            <h2>Dados do Cliente</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="name" type="text" class="form-control" value="{{$Data->name}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Sobre Mim: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="about" type="text" class="form-control" value="{{$Data->about}}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="x_panel">
        @php
        $bank = $Data->bankData;
        @endphp
        <div class="x_title">
            <h2>Dados bancários</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="form-horizontal form-label-left">
                <div class="row">
                    <div class="col-md-12">
                        <label class="label_perfil">Banco</label>
                        <select name="bank_id" id="input" class="form-control" disabled="disabled">
                        <option>{{ $bank->bank_id ? \App\Models\Bank::where('id', $bank->bank_id)->first()->name : 'Nenhum banco selecionado'}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="label_perfil">Agência Bancária</label>
                        <input type="text" class="form-control" disabled="disabled" name="agency" value="{{ $bank->agency }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="label_perfil">Tipo de conta</label>
                        <select name="account_type" id="input" class="form-control" disabled="disabled">
                        <option>{{ $bank->getAccountTypeText() }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="label_perfil">Número da conta:</label>
                        <input type="text" name="account_number" value="{{ $bank->account_number }}" class="form-control" disabled="disabled">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="label_perfil">Nome do titular</label>
                        <input type="text" name="owner_name" value="{{ $bank->owner_name }}" class="form-control" disabled="disabled">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="label_perfil">CPF do titular</label>
                        <input type="text" name="cpf" value="{{ $bank->cpf }}" class="form-control" disabled="disabled">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="x_panel">
        <div class="x_title">
            <h2>Dados de Contato</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Telefone: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="google_maps" type="text" class="form-control show-telefone"
                        value="{{$Data->contact->phone}}"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Celular: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="google_maps" type="text" class="form-control show-celular"
                        value="{{$Data->contact->cellphone}}"
                        disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="x_panel">
        <div class="x_title">
            <h2>Dados de Endereço</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="form-horizontal form-label-left">
                <div class="form-group">
                    <div id="map"><span class="fa fa-spin fa-spinner"></span> Carregando Mapa...</div>
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
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Cep: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control show-cep" value="{{$Data->address->zip}}"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Estado: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control" value="{{$Data->address->state}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Cidade: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control" value="{{$Data->address->city}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Bairro: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control" value="{{$Data->address->district}}"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Rua: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control" value="{{$Data->address->street}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Número: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control" value="{{$Data->address->number}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Complemento: </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input name="zip" type="text" class="form-control" value="{{$Data->address->complement}}"
                        disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
