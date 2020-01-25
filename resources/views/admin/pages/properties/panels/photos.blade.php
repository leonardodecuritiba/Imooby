<style>
    .carousel-inner > .item > img, .carousel-inner > .item > a > img {
        max-height: 400px !important;
    }
</style>
<div class="container">
    <div class="row">
        <div id="myCarousel" class="carousel slide">
            <!-- Dot Indicators -->
            <ol class="carousel-indicators">
                @foreach($Data->properties_photo as $key => $photoproperties)
                    <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{($key==0)?'active':''}}"></li>
                @endforeach
            </ol>
            <!-- Items -->
            <div class="carousel-inner">
                @foreach($Data->properties_photo as $key => $photoproperties)
                    <div class="item {{($key==0)?'active':''}}">
                        <img src="{{$photoproperties->getPhoto()}}" class="img-responsive">
                    </div>
                @endforeach
            </div>
            <!-- Navigation -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
    <div class="ln_solid">
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            {!! Form::open(['method' => 'POST',
                'files' => true, 'multiple' => 'multiple',
                'route'=>[$Page->link.'.update-photos'],
                'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            {{Form::hidden('idproperty', $Data->id)}}
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Adicionar fotos: </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input class="form-control" type="file" name="fotos[]" class="file" multiple="1"
                           data-show-upload="false"
                           data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png"
                           data-browse-class="btn btn-o btn-default" data-browse-label="Carregar Imagens">
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <button type="submit" class="btn btn-success btn-block">Enviar</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label>Galerias de fotos (clique para excluir)</label>
                <div class="file-preview">
                    <div class="file-preview-status text-center text-success"></div>
                    <div class="file-preview-thumbnails">
                        <div class="file-preview-frame">
                            @foreach($Data->properties_photo as $key => $photoproperties)
                                <div class="img-pos pull-left">
                                    <img src="{{$photoproperties->getThumbPhoto()}}"
                                         class="file-preview-image file-preview-image-edit">
                                    <a class="image-remove btn btn-danger btn-xs"
                                       href="{{route('admin-property-photo.destroy',[$photoproperties->id,$Data->id])}}"><span
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
</div>


