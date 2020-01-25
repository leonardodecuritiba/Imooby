@extends('admin.layout.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <!-- Seach form -->
    @include('admin.pages.visits.modal.visits')

    @if(count($Buscas) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$Page->Targets}} encontradas</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Situação</th>
                                <th>Imóvel</th>
                                <th>Proprietário</th>
                                <th>Visitante</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $selecao)
                                <tr>
                                    <td>
                                        {{$selecao->id}}
                                    </td>
                                    <td>
                                        <span class="btn btn-{{$selecao->getStatusColor()}} btn-xs">
                                            <i class="fa fa-{{$selecao->getStatusIcon()}}"></i> {{$selecao->getStatusText()}}</span>
                                    </td>
                                    <td><a target="_blank"
                                           href="{{route('properties.show',[$selecao->property->id,''])}}">{{$selecao->property->title}}</a>
                                    </td>
                                    <td><a target="_blank"
                                           href="{{route('clients.show',$selecao->property->owner->id)}}">{{$selecao->property->owner->name}}</a>
                                    </td>
                                    <td><a target="_blank"
                                           href="{{route('clients.show',$selecao->visitor->id)}}">{{$selecao->visitor->name}}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                           data-dados="{{$selecao}}"
                                           data-status-type="{{$selecao->getStatusColor()}}"
                                           data-status="{{$selecao->getStatus()}}"
                                           data-price="{{$selecao->property->priceTotalReal()}}"
                                           data-image-property="{{$selecao->property->getThumbMainPhoto()}}"
                                           data-image-owner="{{$selecao->property->owner->getThumbPhoto()}}"
                                           data-image-visitor="{{$selecao->visitor->getThumbPhoto()}}"
                                           data-toggle="modal"
                                           data-target="#modalVisit">
                                            <i class="fa fa-eye"></i> Visualizar</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Situação</th>
                                <th>Imóvel</th>
                                <th>Proprietário</th>
                                <th>Visitante</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('admin.layout.search.no-results')
    @endif
    <!-- /page content -->
@endsection
@section('scripts_content')
    <!-- Datatables -->
    @include('helpers.datatables.foot')
    <script>
        $(document).ready(function () {
            $('.dt-responsive').DataTable(
                {
                    "language": language_pt_br,
                    "pageLength": 10,
                    "bLengthChange": false, //used to hide the property
                    "bFilter": false,
                    "order": [0, "desc"]
                }
            );
        });
    </script>
    <!-- /Datatables -->
    <script>
        $('div#modalVisit').on('show.bs.modal', function (e) {

            $origem = $(e.relatedTarget);
            dados_ = $($origem).data('dados');
            status_type_ = $($origem).data('status-type');
            status_ = $($origem).data('status');
            var $url_property = "{{route('properties.show',['XX',''])}}";

            $header = $(this).find('div.modal-header');
            $($header).removeClass();
            $($header).addClass('modal-header').addClass('modal-header-' + status_type_);
            $($header).find('h2.modal-title b').html(dados_.id);
            $($header).find('h2.modal-title i').html(status_);

            //property
            $property = $(this).find('div.modal-body .well .property');
            $($property).find('img').attr('src', $($origem).data('image-property'));
            $($property).find('span#owner').html(dados_.property.title);
            $($property).find('span#price').html($($origem).data('price'));

            //cancelation
            var $cancelation = $(this).find('div.modal-body .well .cancelation');
            $($cancelation).show();
            if ((dados_.cancelation != '') && (dados_.cancelation != null)) {
                $($cancelation).find('span#canceled').html(dados_.cancelation);
                $($cancelation).find('span#idcanceler').html(dados_.canceler.name);
                $($cancelation).find('span#cancellation_reason').html(dados_.cancelation_reason);
            } else {
                $($cancelation).hide();
            }

            var $visitor = $($property).next();
            var $owner = $($visitor).next();

            //visitor
            $($visitor).find('img').attr('src', $($origem).data('image-visitor'));
            $($visitor).find('span#visitor').html(dados_.visitor.name);
            //visitor - message
            var $li = $($visitor).find('li#message');
            var message = ((dados_.visitor_message != '') && (dados_.visitor_message != null)) ? dados_.visitor_message : '<b class="text-danger">Sem mensagens</b>';
            $($li).find('span').html(message);
            //visitor - confirmation
            $li = $($visitor).find('li#confirmation');
            var confirmation = ((dados_.visitor_confirmation != '') && (dados_.visitor_confirmation != null)) ? dados_.visitor_confirmation : '<b class="text-danger">Não confirmado</b>';
            $($li).find('span').html(confirmation);

            //owner
            $($owner).find('img').attr('src', $($origem).data('image-owner'));
            $($owner).find('span#owner').html(dados_.property.owner.name);
            //owner - message
            $li = $($owner).find('li#message');
            var message = ((dados_.visited_message != '') && (dados_.visited_message != null)) ? dados_.visited_message : '<b class="text-danger">Sem mensagens</b>';
            $($li).find('span').html(message);
            //owner - confirmation
            $li = $($owner).find('li#confirmation');
            var confirmation = ((dados_.visited_confirmation != '') && (dados_.visited_confirmation != null)) ? dados_.visited_confirmation : '<b class="text-danger">Não confirmado</b>';
            $($li).find('span').html(confirmation);

            console.log(dados_);
        });
    </script>
@endsection