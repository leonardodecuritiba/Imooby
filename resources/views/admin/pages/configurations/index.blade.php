@extends('admin.layout.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <!-- Seach form -->

    @if(count($Buscas) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$Page->Targets}} encontradas</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table class="table table-striped table-bordered dt-responsive" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th width="60%">Valor</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $selecao)
                                <tr>
                                    {!! Form::open(['method' => 'PATCH',
                                    'route'=>[$Page->link.'.update',$selecao->id],
                                    'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                                        <td>
                                            {{$selecao->id}}
                                        </td>
                                        <td>
                                            {{$selecao->meta_key}}
                                        </td>
                                        <td>
                                            <span class="value-control">{{$selecao->name}}</span>
                                            <input name="name" style="width: 100%" type="text" maxlength="100"
                                                   class="form-control hide field-control" required
                                                   value="{{$selecao->name}}">
                                        </td>
                                        <td>
                                            <span class="value-control">{{$selecao->meta_value}}</span>
                                            <textarea name="meta_value" style="width: 100%" type="text" rows="3"
                                                   class="form-control hide field-control" required>{{$selecao->meta_value}}</textarea>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-edit-control">
                                                <i class="fa fa-edit"></i> Editar</a>
                                            <button class="btn btn-success hide btn-save-control">
                                                <i class="fa fa-save"></i> Salvar</button>
                                            <a class="btn btn-danger hide btn-cancel-control">
                                                <i class="fa fa-times"></i> Cancelar</a>
                                        </td>
                                    {!! Form::close() !!}
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
    {{--{!! Html::script('assets_admin/parsley.min.js') !!}--}}
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
                    "order": [0, "asc"]
                }
            );
        });
    </script>
    <!-- /Datatables -->
    <script>
        $(document).ready(function () {
            $('a.btn-edit-control').click(function () {
                var $parent = $(this).parents('tr');
                $parent.find('.field-control').removeClass('hide');
                $parent.find('.btn-save-control').removeClass('hide');
                $parent.find('.btn-cancel-control').removeClass('hide');

                $parent.find('.value-control').addClass('hide');
                $parent.find('.btn-edit-control').addClass('hide');
            });
            $('a.btn-cancel-control').click(function () {
                var $parent = $(this).parents('tr');
                $parent.find('.field-control').addClass('hide');
                $parent.find('.btn-save-control').addClass('hide');
                $parent.find('.btn-cancel-control').addClass('hide');

                $parent.find('.value-control').removeClass('hide');
                $parent.find('.btn-edit-control').removeClass('hide');
            });
        });
    </script>
@endsection