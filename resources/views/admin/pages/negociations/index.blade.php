@extends('admin.layout.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <!-- Seach form -->
    {{--@include('admin.pages.visits.modal.visits')--}}

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
                                <th>Locatário</th>
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
                                           href="{{route('clients.show',$selecao->renter->id)}}">{{$selecao->renter->name}}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                           href="{{route('negociations.show',$selecao->id)}}">
                                            <i class="fa fa-eye"></i> Visualizar</a>
                                    </td>
                                </tr>
                            @endforeach
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
    </script>
@endsection