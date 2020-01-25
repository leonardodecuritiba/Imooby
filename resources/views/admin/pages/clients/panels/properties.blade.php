<section class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Imóveis</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if($Data->properties->count() > 0)
                    <ul class="list-unstyled msg_list">
                        @foreach($Data->properties as $property)
                            <li>
                                <a href="{{route('properties.show', [$property->id,''])}}" target="_blank">
                                        <span class="image">
                                            <img src="{{$property->getThumbMainPhoto()}}" alt="img"/>
                                        </span>
                                    <span>
                                            <span>{{$property->title}}</span>
                                            <span class="time">{{$property->created_at}}</span>
                                        @if($property->status)
                                            <button class="btn btn-success btn-xs" role="alert"><i class="fa fa-check"
                                                                                                   aria-hidden="true"></i></button>
                                        @else
                                            <button class="btn btn-danger btn-xs" role="alert"><i class="fa fa-times"
                                                                                                  aria-hidden="true"></i></button>
                                        @endif
                                        </span>
                                    <span class="message">
                                        {{$property->description}}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="row jumbotron">
                        <h1>Ops!</h1>
                        <h2>{{trans('messages.crud.'.$Page->Sex.'GE2', ['name' => 'Imóvel'])}}</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
