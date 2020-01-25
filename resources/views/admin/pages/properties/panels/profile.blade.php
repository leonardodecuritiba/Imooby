<p>{{$Data->description}}</p>
<div class="product_price">
    <h1 class="text-info">{{$Data->priceTotalReal()}}</h1>
    {{--<span class="price-tax">Ex Tax: Ksh80.00</span>--}}
    {{--<br>--}}
</div>

<div class="">
    <a class="btn btn-danger pull-right btn-xs"
       data-nome="Imóvel #: {{$Data->id}}"
       data-href="{{route($Page->link.'.destroy',$Data->id)}}"
       data-toggle="modal"
       data-target="#modalExclusao">
        <i class="fa fa-trash-o"></i> Excluir </a>
    <h3>Características</h3>
    <div class="profile_details">
        <div class="well profile_view" style="width: 100%">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <ul class="list-unstyled project_files">
                    <li><i class="fa fa-info"></i> Tipo de Imóvel:
                        <b>{{$Data->getPropertyTypeText()}}</b></li>
                    <li><i class="fa fa-info"></i> Número de quartos:
                        <b>{{$Data->bathroom_n}}</b></li>
                    <li><i class="fa fa-info"></i> Número de Banheiros:
                        <b>{{$Data->bedroom_n}}</b></li>
                </ul>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <ul class="list-unstyled project_files">
                    <li><i class="fa fa-info"></i> Área Interna:
                        <b>{{$Data->getInternalArea()}}</b></li>
                    <li><i class="fa fa-info"></i> Área Externa:
                        <b>{{$Data->getExternalArea()}}</b></li>
                </ul>
            </div>
        </div>
        <div class="amenities">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->garage) green @endif"><span
                            class="fa fa-car "></span> Garagem
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->reception) green @endif"><span
                            class="fa fa-arrows-v"></span> Portaria 24 horas
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->air_conditioning) green @endif"><span
                            class="fa fa-asterisk"></span> Ar Condicionado
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->outdoor_pool) green @endif"><span
                            class="fa fa-tint"></span> Piscina
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->garden) green @endif"><span
                            class="fa fa-leaf"></span> Jardim
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->fireplace) green @endif"><span
                            class="fa fa-fire"></span> Lareira
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->animals) green @endif"><span
                            class="fa fa-paw"></span> Aceita Pets
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->playground) green @endif"><span
                            class="fa fa-child"></span> Playground
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->hydro) green @endif"><span
                            class="fa fa-tint"></span> Banheira Hidro
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->grill) green @endif"><span
                            class="fa fa-fire"></span> Churrasqueira
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->laundry) green @endif"><span
                            class="fa fa-tint"></span> Lavanderia
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 @if($Data->furnished) green @endif"><span
                            class="fa fa-institution"></span> Mobiliado
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
{{--<div class="">--}}
{{--<button type="button" class="btn btn-default btn-lg">Add to Cart</button>--}}
{{--<button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>--}}
{{--</div>--}}
{{--<div class="product_social">--}}
{{--<ul class="list-inline">--}}
{{--<li><a href="#"><i class="fa fa-facebook-square"></i></a>--}}
{{--</li>--}}
{{--<li><a href="#"><i class="fa fa-twitter-square"></i></a>--}}
{{--</li>--}}
{{--<li><a href="#"><i class="fa fa-envelope-square"></i></a>--}}
{{--</li>--}}
{{--<li><a href="#"><i class="fa fa-rss-square"></i></a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}