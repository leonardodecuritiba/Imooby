@extends('site.layouts.institucional.template')
@section('styles_content')

    <style type="text/css">
        body {
            padding-right: 0px !important;
        }
    </style>
@endsection
@section('body_content')
    <!--========== HEADER ==========-->
    @include('site.layouts.menu.home.navbar')
    <!--========== END HEADER ==========-->

    <!--========== SLIDER ==========-->
    @include('site.layouts.menu.home.search')
    <!--========== SLIDER ==========-->

    <!--========== PAGE LAYOUT ==========-->
    <!-- Products -->
    <div style="background-color: #00a7ec;">
        <div class="container">
            <div class="row" style="padding-top: 60px; padding-bottom: 200px;">
                <div class="col-md-12 text-center">
                    <h1 style="color: #fff; font-weight: normal;">Nossos <b>Serviços</b></h1>
                    <center>
                        <div style="height: 5px; width: 100px; background-color: #f8e312"></div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- End Products -->

    <div class="container" style="background-color: #fff; margin-top: -150px; padding: 20px 35px;">
        <div class="row">
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-map-marker icone_servico"></i>
                    <h3>Busca Rápida</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Busque seu imóvel pelo mapa utilizando os filtros para personalizar sua
                        procura,
                        antes da publicação, todos os anúncios são verificados pela nossa equipe.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-calendar icone_servico"></i>
                    <h3>Agendamento Online</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Agende sua visita pela plataforma e aguarde a notificação de confirmação,
                        rápido e
                        prático, não precisa telefonar para ninguém.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-home icone_servico"></i>
                    <h3>Alugue Sem Fiador</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Negocie direto com o proprietário, alugue sem os constrangimentos de correr
                        atrás
                        de fiador, seguradora, ou realizar depósitos caução.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-lock icone_servico"></i>
                    <h3>Segurança</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Envie seus documentos e assine o contrato sem sair de casa. Todo o processo é
                        realizado digitalmente o que torna sua locação muito mais rápida e segura.</p>
                </div>
            </div>
        </div>
        <!--// end row -->

        <div class="row" style="padding-top: 30px; padding-bottom: 100px;">
            <div class="col-md-12 text-center" style="margin-bottom: 30px;">
                <h1 style="color: #00a7ec; font-weight: normal;">Imóveis Adicionados <b>Recentemente</b></h1>
                <center>
                    <div style="height: 5px; width: 100px; background-color: #f8e312"></div>
                </center>
            </div>
            <div class="row">
                @foreach($_SELF_TEMPLATE_['Properties'] as $key => $property)
                    <div class="col-md-4">
                        <div class="div_imovel">
                            <img src="{{$property->getThumbMainPhoto()}}" class="imagem_imovel" alt=""/>
                            <div>
                                <label class="label label-primary condicao">{{$property->getType()}}</label>
                                <a href="{{route('ver-imovel',$property->id)}}">
                                    <label class="valor_imovel">{{$property->priceTotalReal()}}</label><br>
                                    <label class="cidade_imovel">{{$property->address->getStateCity()}}</label><br>
                                    <label class="endereco_imovel">{{$property->address->getFullAddress()}}</label>

                                    {{--<i class="fa fa-star estrela_amarela"></i>--}}
                                    {{--<i class="fa fa-star estrela_amarela"></i>--}}
                                    {{--<i class="fa fa-star estrela_amarela"></i>--}}
                                    {{--<i class="fa fa-star estrela_amarela"></i>--}}
                                    {{--<i class="fa fa-star-o"></i>--}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--========== END PAGE LAYOUT ==========-->

    <!--========== FOOTER ==========-->
    @include('site.layouts.institucional.footer')
    <!--========== END FOOTER ==========-->

@endsection
@section('scripts_content')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-104490441-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script type="text/javascript">
        function fechar_cadastrar() {
            $('#modal_cadastrar').removeClass('show');
        }
    </script>
    @include('site.layouts.map.googleapijs')
    <script type="text/javascript">
    var buscurl = '{{Form::open(['route' =>'buscar-imoveis', 'method' => 'GET'])}}';
    </script>
    <script src="{{asset('js/institucional.min.js')}}" type="text/javascript"></script>
@endsection