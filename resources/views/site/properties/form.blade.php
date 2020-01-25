
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
            <label>Título do anúncio</label>
            <input name="title" type="text" class="form-control" maxlength="100"
                   placeholder="Digite o título do anúncio"
                   value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->title:old('title')}}"
                   required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>Tipo</label>
            <select name="idproperties_type" class="form-control"
                    style="padding-top: 8px; padding-bottom: 8px;" required>
                @foreach($_SELF_TEMPLATE_['PropertiesType'] as $selection)
                    <option value="{{$selection->id}}"
                            {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->idproperties_type == $selection->id)?'selected':''}}
                    >{{$selection->description}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row" id="valores">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="form-group">
            <label>Aluguel</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control show-valor" type="text" name="price_rental"
                       placeholder="0,00" onkeyup="calc_valores(this)"
                       value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->priceRentalFormated():''}}"
                       required="">
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="form-group">
            <label>Condomínio</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control show-valor" type="text" name="price_condominium"
                       placeholder="0,00" onkeyup="calc_valores(this)"
                       value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->priceCondominiumFormated():''}}">
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="form-group">
            <label>IPTU</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control show-valor" type="text" name="price_iptu"
                       placeholder="0,00" onkeyup="calc_valores(this)"
                       value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->priceIptuFormated():''}}">
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="form-group">
            <label>Taxa de Serviço</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control show-valor" type="text" name="fee" placeholder="0,00"
                       value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->priceFeeFormated():''}}"
                       disabled>
            </div>
            <a href="#" class="floaticon-input" data-toggle="popover"  data-trigger="hover" data-container="body" title="Taxa de Serviço" data-content="Taxa cobrada mensalmente do inquilino, isso nos ajuda a manter nossa plataforma e a oferecer serviços, como a garantia do proprietário receber o aluguel no dia combinado."><i class="fa fa-question-circle" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>Valor total</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control show-valor" type="text" name="total" placeholder="0,00"
                       value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->priceTotalFormated():''}}"
                       disabled>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label>Descrição</label>
    <textarea class="form-control" rows="4" name="description" maxlength="512"
              placeholder="Digite a descrição do seu anúncio"
              required="">{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->description:''}}</textarea>
</div>
<div class="form-group">
    <input type="hidden" name="lat" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->lat:''}}" required>
    <input type="hidden" name="lng" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->lng:''}}" required>
    <input type="hidden" name="zip" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->zip:''}}" required>
    <input type="hidden" name="state" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->state:''}}" required>
    <input type="hidden" name="city" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->city:''}}" required>
    <input type="hidden" name="district" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->district:''}}" required>
    <input type="hidden" name="street" value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->street:''}}" required>
    <label>Endereço<span id="txtLatitude" class="label label-default"
                            style="margin-left: 10px; margin-right: 10px;"></span> <span
                id="txtLongitude" class="label label-default"></span></label>
    <input class="form-control" type="text" id="txtEndereco" {{(isset($_SELF_TEMPLATE_['Property']))?'':'required'}}
           placeholder="Você pode arrastar o marcador para a posição necessária" autocomplete="off">
    <p class="help-block">Você pode arrastar o marcador para a posição necessária</p>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <label>Número</label>
            <input type="text" name="number" class="form-control"
                   value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->number:''}}"
                   required="">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <label>Complemento</label>
            <input type="text" name="complement"
                   value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->address->complement:''}}"
                   class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Quartos</label>
            <input type="number" name="bedroom_n" class="form-control"
                   value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->bedroom_n:''}}"
                   required="">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Banheiros</label>
            <input type="number" name="bathroom_n" class="form-control"
                   value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->bathroom_n:''}}"
                   required="">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Vagas</label>
            <input type="number" name="garage_n" class="form-control"
                   value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->garage_n:''}}"
                   >
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Área útil</label>
            <div class="input-group">
                <input class="form-control show-valor" name="internal_area" type="text"
                       value="{{(isset($_SELF_TEMPLATE_['Property']))?$_SELF_TEMPLATE_['Property']->internalAreaFormated():''}}"
                       required="">
                <div class="input-group-addon">M²</div>
            </div>
        </div>
    </div>
</div>
@if(isset($_SELF_TEMPLATE_['Property']) && ($_SELF_TEMPLATE_['Property']->properties_photo->count() > 0))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label>Galerias de fotos (clique para excluir)</label>
                <div class="file-preview">
                    <div class="file-preview-status text-center text-success"></div>
                    <div class="file-preview-thumbnails">
                        <div class="file-preview-frame">
                            @foreach($_SELF_TEMPLATE_['Property']->properties_photo as $key => $photoproperties)
                                <div class="img-pos pull-left">
                                    <img src="{{$photoproperties->getPhoto()}}"
                                         class="file-preview-image file-preview-image-edit">
                                    <a class="image-remove btn btn-danger btn-xs"
                                       data-url="{{route('property-photo.destroy',$photoproperties->id)}}"><span
                                                class="fa fa-trash"></span></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label>Adicionar fotos</label>
            <input type="file" name="fotos[]" class="file" multiple="1" data-show-upload="false"
                   data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png"
                   data-browse-class="btn btn-o btn-default" data-browse-label="Carregar Imagens">
            <p class="help-block">Você pode adicionar várias imagens de uma só vez</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>Características</label>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->reception)?'checked':''}}
                                                                name="reception"><span
                            class="fa fa-check"></span> Portaria 24 horas</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->air_conditioning)?'checked':''}}
                                                                name="air_conditioning"><span
                            class="fa fa-check"></span> Ar Condicionado</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->outdoor_pool)?'checked':''}}
                                                                name="outdoor_pool"><span
                            class="fa fa-check"></span> Piscina</label></div>
                            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->suite)?'checked':''}}
                                                                name="suite"><span
                            class="fa fa-check"></span> Suite</label></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>&nbsp;</label>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->garden)?'checked':''}}
                                                                name="garden"><span
                            class="fa fa-check"></span> Jardim</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->fireplace)?'checked':''}}
                                                                name="fireplace"><span
                            class="fa fa-check"></span> Lareira</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->animals)?'checked':''}}
                                                                name="animals"><span
                            class="fa fa-check"></span> Aceita Pets</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->playground)?'checked':''}}
                                                                name="playground"><span
                            class="fa fa-check"></span> Playground</label></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>&nbsp;</label>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->hydro)?'checked':''}}
                                                                name="hydro"><span
                            class="fa fa-check"></span> Banheira Hidro</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->grill)?'checked':''}}
                                                                name="grill"><span
                            class="fa fa-check"></span> Churrasqueira</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->laundry)?'checked':''}}
                                                                name="laundry"><span
                            class="fa fa-check"></span> Lavanderia</label></div>
            <div class="checkbox custom-checkbox"><label><input type="checkbox"
                                                                {{(isset($_SELF_TEMPLATE_['Property']) && $_SELF_TEMPLATE_['Property']->furnished)?'checked':''}}
                                                                name="furnished"><span
                            class="fa fa-check"></span> Mobiliado</label></div>
        </div>
    </div>
</div>
<div class="form-group">
    @if(isset($_SELF_TEMPLATE_['Property']))
        <button class="btn btn-green btn-lg" style="border-radius: 0px;"><i class="fa fa-save"></i> Salvar Alterações</button>
        <a href="{{route('profile.properties')}}" class="btn btn-warning btn-lg" style="border-radius: 0px;"><i class="fa fa-arrow-left"></i> Voltar para Imóveis</a>
    @else
        @if(!Auth::check() || !Auth::user()->hasRole('client'))
            <a href="#" class="btn btn-green btn-lg"
               data-toggle="modal" data-target="#modal_danger"
               style="border-radius: 0px;">Cadastrar Imóvel
            </a>
        @else
            <button href="#" class="btn btn-green btn-lg"
                    style="border-radius: 0px;">Cadastrar Imóvel
            </button>
        @endif
    @endif
</div>