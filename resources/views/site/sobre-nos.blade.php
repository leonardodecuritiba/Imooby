@extends('site.layouts.institucional.template')
@section('styles_content')

    <style type="text/css">
        body {
            padding-right: 0px !important;
        }

        .texto_sobre {
            padding-top: 70px;
        }
    </style>

    <style type="text/css">
        .cor_texto {
            color: #00a7ec;
        }

        .btn_enviar {
            background-color: #3cd65a;
            border-color: #3cd65a;
            color: #fff;
            border-radius: 0px;
            font-weight: bold;
        }

        .fonte_texto_contato {
            color: #a7a7a7;
            font-weight: 300;
            font-size: 12px;
        }

        .linha_contato {
            border: 2px solid #eee;
            margin-bottom: 20px;
            padding: 2px;
        }
    </style>


@endsection
@section('modals_content')
    @if (count($errors) > 0)
        @include('site.layouts.alerts.danger')
    @endif
    @if (session()->has('mensagem'))
        @include('site.layouts.alerts.success')
    @endif
@endsection
@section('body_content')

    <!--========== HEADER ==========-->
    @include('site.layouts.menu.home.navbar')
    <!--========== END HEADER ==========-->

    <!--========== SLIDER ==========-->
    {{--@include('site.layouts.menu.home.search')--}}
    <!--========== SLIDER ==========-->


    <!--========== PAGE LAYOUT ==========-->
    <!-- Products -->
    <div id="products" style="background-color: #00a7ec;">
        <div class="container">
            <div class="row" style="padding-top: 60px; padding-bottom: 200px;">
                <div class="col-md-12 text-center">
                    <h1 style="color: #fff; font-weight: normal;">Sobre <b>Nós</b></h1>
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
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{asset('assets_site/img/placa.png')}}" style="width: 100%;">
                </div>
                <div class="col-md-6 texto_sobre">
                    <h2>Democratizamos o processo de locação</h2>
                    <p>O Imooby é uma startup com a missão de simplificar todas as etapas que envolvem o processo de
                        locação de imóveis residencias. Nossa plataforma conecta proprietários e inquilinos de forma
                        fácil e segura. Além da alta procura e visibilidade do seu imóvel em nosso site, nós também
                        criamos parcerias com os maiores portais imobiliários do Brasil.</p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-6 hidden-xs hidden-sm texto_sobre">
                    <h2>Tudo sem burocracia</h2>
                    <p>Desenvolvemos um modelo de negócio enxuto e inovador, para que ambos possam fechar negócio com
                        garantia e rapidez, sem precisar correr atrás de fiador, seguradoras ou prejudicar seu fluxo de
                        caixa efetuando depósitos caução. O melhor de tudo, é que ainda assim, o dono do imóvel tem a
                        garantia e tranquilidade de receber o dinheiro do aluguel em sua conta bancária no dia
                        combinado, mesmo quando o inquilino atrasar o pagamento.</p>
                </div>
                <div class="col-md-6 hidden-xs hidden-sm text-center">
                    <img src="{{asset('assets_site/img/burocracia.png')}}" style="width: 100%;">
                </div>

                <div class="col-md-6 hidden-md hidden-lg text-center">
                    <img src="{{asset('assets_site/img/burocracia.png')}}" style="width: 100%;">
                </div>
                <div class="col-md-6 hidden-md hidden-lg texto_sobre">
                    <h2>Tudo sem burocracia</h2>
                    <p>Desenvolvemos um modelo de negócio enxuto e inovador, para que ambos possam fechar negócio com
                        garantia e rapidez, sem precisar correr atrás de fiador, seguradoras ou prejudicar seu fluxo de
                        caixa efetuando depósitos caução. O melhor de tudo, é que ainda assim, o dono do imóvel tem a
                        garantia e tranquilidade de receber o dinheiro do aluguel em sua conta bancária no dia
                        combinado, mesmo quando o inquilino atrasar o pagamento.</p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-6 text-center">
                    <img src="{{asset('assets_site/img/presenca.png')}}" style="width: 100%;">
                </div>
                <div class="col-md-6 texto_sobre">
                    <h2>Presença online</h2>
                    <p>Utilizamos tecnologia para deixar tudo muito mais simples, a maior parte do processo de locação é
                        realizado online, desde o agendamento da visita, até a assinatura do contrato. Disponibilizamos
                        para ambos um modelo padrão de contrato de aluguel, desenvolvido por um grande escritório de
                        advocacia. O contrato de locação é digital com assinatura eletrônica, cuidamos para que tudo
                        esteja dentro da lei.</p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px; margin-bottom: 60px;">
                <div class="col-md-6 hidden-xs hidden-sm texto_sobre">
                    <h2>Suporte diferenciado</h2>
                    <p>Em caso de dúvidas, você ainda pode contar nossa equipe através de um dos nossos diversos canais
                        de atendimento, nós guiamos você passo-a-passo. Vamos começar?</p>
                </div>
                <div class="col-md-6 hidden-xs hidden-sm text-center">
                    <img src="{{asset('assets_site/img/suporte.png')}}" style="width: 100%;">
                </div>

                <div class="col-md-6 hidden-md hidden-lg text-center">
                    <img src="{{asset('assets_site/img/suporte.png')}}" style="width: 100%;">
                </div>
                <div class="col-md-6 hidden-md hidden-lg texto_sobre">
                    <h2>Suporte diferenciado</h2>
                    <p>Em caso de dúvidas, você ainda pode contar nossa equipe através de um dos nossos diversos canais
                        de atendimento, nós guiamos você passo-a-passo. Vamos começar?</p>
                </div>
            </div>
        </div>
        <!--// end row -->
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
        $(document).ready(function () {
            $('#modal_sucesso').modal('show');
        })
    </script>
@endsection