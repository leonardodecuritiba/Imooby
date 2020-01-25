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
    {{--@include('site.layouts.menu.home.search')--}}
    <!--========== SLIDER ==========-->

    <!--========== PAGE LAYOUT ==========-->
    <!-- Products -->
    <div id="products" style="background-color: #00a7ec;">
        <div class="container">
            <div class="row" style="padding-top: 60px; padding-bottom: 200px;">
                <div class="col-md-12 text-center">
                    <h1 style="color: #fff; font-weight: normal;">Para você <b>Inquilino</b></h1>
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
                    <i class="fa fa-user-circle icone_servico"></i>
                    <h3>Sem Fiador</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Não precisa correr atrás de fiador, seguro fiança ou efetuar depósitos
                        caução.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-money icone_servico"></i>
                    <h3>Comprovar Renda</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Você pode incluir até 4 moradores para comprovar a renda necessária para
                        locação.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-home icone_servico"></i>
                    <h3>Facilidade</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Processo simplificado, sem passar pela burocracia de imobiliárias ou
                        seguradoras.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-book icone_servico"></i>
                    <h3>Segurança</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Anúncios verificados e contratos muito bem elaborados com base na lei do
                        inquilinato.</p>
                </div>
            </div>
        </div>
        <!--// end row -->

        <div class="row" style="padding-top: 30px; padding-bottom: 100px;">
            <div class="col-md-12 text-center" style="margin-bottom: 30px;">
                <h1 style="color: #00a7ec; font-weight: normal;">Veja como é <b>prático e rápido</b></h1>
                <center>
                    <div style="height: 5px; width: 100px; background-color: #f8e312"></div>
                </center>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">1 -</b> AGENDE SUAS VISITAS
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Cadastre-se em nossa plataforma gratuitamente e agende suas
                                visitas, agora você só precisa aguardar pela notificação de confirmação da sua visita,
                                que será enviada pelo proprietário do imóvel.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">2 -</b> ENVIAR PROPOSTA DE LOCAÇÃO
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Gostou do imóvel? Agora você deve acessar o seu cadastro em nosso
                                site e através da opção “minhas negociações” e de forma muito simples enviar sua
                                proposta de locação.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">3 -</b> ENVIO DE DOCUMENTAÇÃO
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Proposta aceita, nessa etapa você deverá submeter sua
                                documentação para análise e elaboração de contrato. Na sequência vamos disponibilizar
                                para ambos um contrato de aluguel padrão, desenvolvido por um grande escritório de
                                advocacia com base na lei do inquilinato Nº 8245/91.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">4 -</b> CONTRATO DIGITAL
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Os contratos serão disponibilizados digitalmente com assinatura
                                eletrônica conforme lei Nº 2.200-2/2001, proporcionando maior agilidade, segurança e
                                prezando pela garantia jurídica de ambas as partes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">5 -</b> NEGÓCIO FECHADO
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Simples e rápido. Agora basta agendar a entrega chaves e realizar
                                sua mudança. Caso ainda tenha dúvidas de como funciona, fique tranquilo, você pode
                                contar com uma super equipe que vai guiar você passo-a-passo.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="background-image: url('{{asset('assets_site/img/como_funciona.png')}}'); background-repeat: no-repeat; background-size: cover;">
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="padding-top: 70px; padding-bottom: 70px;">
                <h1 class="text-center" style="color: #fff;">Quanto custa alugar com a imooby?</h1>
                <p class="text-center functext">Quando você aluga um imóvel pela nossa
                    plataforma, nós cobramos mensalmente uma taxa de 8% referente a transação de pagamento via boleto ou
                    débito em conta. Esse valor já está incluso nos valores finais dos anúncios com a descrição de
                    “taxa de serviço”.</p>
                <center>
                    <a class="btn btn-primary btn-lg anunciar text" href="{{route('buscar-imoveis')}}"
                       style="padding: 15px 20px;font-size:1em">PESQUISAR IMÓVEIS</a>
                </center>
            </div>
        </div>
    </div>
    <!--========== END PAGE LAYOUT ==========-->

    <!--========== FOOTER ==========-->
    @include('site.layouts.institucional.footer')
    <!--========== END FOOTER ==========-->

@endsection
@section('scripts_content')

@endsection