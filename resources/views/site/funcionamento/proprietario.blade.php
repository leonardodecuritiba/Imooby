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
                    <h1 style="color: #fff; font-weight: normal;">Para você <b>Proprietário</b></h1>
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
                    <i class="fa fa-lock icone_servico"></i>
                    <h3>Garantia</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Garantia do aluguel em dia, mesmo quando o inquilino atrasar o pagamento.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-refresh icone_servico"></i>
                    <h3>Rapidez</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Seu imovel aluga mais rápido, nós inovamos o processo para simplificar a
                        locação.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-thumbs-o-up icone_servico"></i>
                    <h3>Qualidade</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Após o término do contrato receba seu imóvel em boas condições.</p>
                </div>
            </div>
            <div class="fora">
                <div class="col-md-3 text-center dentro">
                    <i class="fa fa-list icone_servico"></i>
                    <h3>Anunciar</h3>
                    <center class="linha_div">
                        <div class="linha"></div>
                    </center>
                    <p class="margin-b-5">Não exigimos exclusividade para anunciar seu imóvel em nosso site.</p>
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
                            <b style="font-size: 30px;">1 -</b> ANUNCIE SEU IMÓVEL GRATUITAMENTE
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Anúncie seu imóvel gratuitamente e receba agendamentos online de
                                visitas através da nossa plataforma, as visitas serão gerenciadas por você mesmo, afinal
                                de contas, quem melhor do que você para escolher seu futuro inquilino.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">2 -</b> VISITAÇÃO DO IMÓVEL
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Após visitar seu imóvel, o inquilino deve encaminhar uma proposta
                                de locação através da nossa plataforma, nesta etapa você precisa apenas clicar em
                                aceitar, para confirmar o interesse de prosseguir com a negociação.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading"
                             style="background-color: #00a7ec; color: #fff; font-size: 22px; font-weight: bold; border-radius: 0px; border-color: #00a7ec;">
                            <b style="font-size: 30px;">3 -</b> ANÁLISE DE CRÉDITO E DOCUMENTAÇÃO
                        </div>
                        <div class="panel-body text-center"
                             style="padding: 40px; border-radius: 0px; border: 1px solid #00a7ec;">
                            <p style="color: #151515;">Proposta confirmada. Nossa equipe vai cuidar da análise de
                                crédito e levantamento de toda documentação necessária. Na sequência vamos
                                disponibilizar para ambos um contrato de aluguel padrão, desenvolvido por um grande
                                escritório de advocacia com base na lei do inquilinato Nº 8245/91.</p>
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
                            <p style="color: #151515;">Simples e rápido. Agora basta agendar a entrega chaves e ter a
                                garantia de receber seu aluguel no dia combinado. Caso ainda tenha dúvidas de como
                                funciona, fique tranquilo, você pode contar com uma super equipe que vai guiar você
                                passo-a-passo.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="background-image: url('{{asset('assets_site/img/como_funciona.png')}}'); background-repeat: no-repeat; background-size: cover;">
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="padding-top: 70px; padding-bottom: 70px;">
                <h1 class="text-center" style="color: #fff;">Quanto custa anunciar com a Imooby?</h1>
                <p class="text-center functext">
                    Você não paga nada para anunciar com a gente.<br><br>
                    Somente quando seu imóvel é alugado pela nossa plataforma, nós cobramos 100% do primeiro aluguel.
                    Nenhuma outra taxa será cobrada do proprietário, ou seja, a partir do segundo mês de locação, você
                    já começa a receber 100% do valor do aluguel até o término do contrato.<br><br>
                    Ainda está com dúvidas? <a href="{{ route('contactus') }}"  style="color:#00b4ff;font-weight: bold;">Clique aqui</a>
                    para conversar com a nossa equipe :)</p>
                <center>
                    <a class="btn btn-primary btn-lg anunciar text" target="_BLANK" href="{{route('property.create')}}"
                       style="padding: 15px 20px; font-size: 1em">ANUNCIAR IMÓVEIS</a>
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