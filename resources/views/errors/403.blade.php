@extends('site.layouts.institucional.template')
@section('styles_content')
@endsection
@section('body_content')

    <!--========== HEADER ==========-->
    @include('site.layouts.menu.home.navbar')
    <!--========== END HEADER ==========-->

    <!--========== PAGE LAYOUT ==========-->
    <div style="background-color: #00a7ec;margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: #fff; margin-top: 50px">
                    <div class="panel panel-default" style="border-radius: 0px; padding: 20px;">
                        <div class="panel-body">
                            <h1 style="color: #00a7ec; font-weight: normal;">Ops, <b>ERRO 403</b></h1>
                            <p>Você não tem acesso para visualizar essa página.<br><a href="index.php"
                                                                                      style="font-weight: bold;">Clique
                                    aqui</a> para retornar à página inicial.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--========== END PAGE LAYOUT ==========-->

    <!--========== FOOTER ==========-->
    @include('site.layouts.institucional.footer')
    <!--========== END FOOTER ==========-->

@endsection
@section('scripts_content')
    <script type="text/javascript">
        function fechar_cadastrar() {
            $('#modal_cadastrar').removeClass('show');
        }
    </script>
@endsection