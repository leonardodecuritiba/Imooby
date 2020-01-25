@extends('site.layouts.institucional.template')
@section('styles_content')
<style type="text/css">
    body {
        padding-right: 0px !important;
    }

    .politics-terms p {
        color: black !important;
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
                <h1 style="color: #fff;">Política de Privacidade</h1>
                <center>
                    <div style="height: 5px; width: 100px; background-color: #f8e312"></div>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- End Products -->
<div class="container politics-terms" style="background-color: #fff; margin-top: -150px; padding: 20px 35px;">
<h5>Definições:</h5>
    <table class="table table-hover">
        <tbody>
            <tr>
                <td><strong>SITE</strong></td>
                <td>É a empresa proprietária do portal https://www.imooby.com</td>
            </tr>
            <tr>
                <td><strong>IMOOBY</strong></td>
                <td>É o portal cujo endereço é https://www.imooby.com, com todos os recursos e serviços relacionados a este.</td>
            </tr>
            <tr>
                <td><strong>USUÁRIO</strong></td>
                <td>Aqueles que acessam o Imooby.</td>
            </tr>
            <tr>
                <td><strong>ANUNCIANTE</strong></td>
                <td>Aquele que têm inserido seus anúncios ou publicidade no Imooby. </td>
            </tr>
            <tr>
                <td><strong>INQUILINO</strong></td>
                <td>Aquele que locar imóvel disponibilizado pelo anunciante.</td>
            </tr>
        </tbody>
    </table>
<p>O Imooby sabe da importância ao usuário em conhecer e estar seguro sobre a utilização dos seus dados pessoais. Este documento tem como finalidade esclarecer e divulgar nossa política de utilização dessas informações, para que o usuário entenda quais informações são obtidas e a forma como são utilizadas. Dedique alguns minutos do seu tempo para ler essa política e aproveitar de forma consciente e segura tudo o que o Imooby tem para oferecer. </p>

<h4>1. TERMO DE USO</h4>
<p>O usuário expressamente aceita os termos e condições elencados no <a href="{{ route('termos-de-uso') }}">Termo de Uso</a>, os quais ficam aqui incorporados por referência.</p>
<h4>2. DAS INFORMAÇÕES COLETADAS E ARMAZENAMENTO</h4>
<p>2.1 O Imooby coleta informações direta ou indiretamente, sendo a maioria delas obtidas durante o processo de criação de conta de usuário, quando é necessário o preenchimento de nome, endereço de e-mail e outras informações. Quanto mais informações corretas você fornecer, melhor será sua experiência no site. </p>
<p>2.2 O objetivo do Imooby ao coletar, acessar, armazenar ou transferir dados dos usuários é possibilitar a utilização do site da forma mais segura possível e melhorar periodicamente os serviços oferecidos. </p>
<p>2.3 Podem também ser colhidas informações dos usuários quando entram em contato com o Imooby pelos canais de atendimento disponíveis no site. </p>
<p>2.4 Podem ser coletados os seguintes tipos de informação: 
<br>a) dados cadastrais, que tem como finalidade identificar ou contatar usuários para viabilizar a prestação dos serviços oferecidos e trazer segurança e transparência nas interações entre usuários; 
<br>b) dados bancários: essenciais para processamento de pagamentos, cobranças e repasses relacionados aos serviços contratados pelo usuário, utilizadas exclusivamente para esta finalidade. Estas informações são tratadas com absoluta confidencialidade e segurança. 
<br>c) dados de crédito: utilizados para avaliar as condições de créditos de um usuário, especialmente para verificar as condições de o potencial inquilino arcar com os custos da locação. Estas informações poderão ser compartilhadas com empresas parceiras e anunciantes dos imóveis para quem o inquilino tenha feito uma proposta formal de locação. 
<br>d) dados anônimos: colhidas de forma individual, coletiva ou agregada para analisar o comportamento do usuário sem revelar sua identidade, especialmente no intuito de evitar fraudes, realizar estudos mercadológicos ou ainda personalizar o site, serviços e propaganda. 
</p>
<p>2.5 O usuário garante e responde pela veracidade, exatidão, vigência e autenticidade dos dados pessoais, e compromete-se a mantê-los devidamente atualizados. Por este motivo, o Imooby não possui qualquer responsabilidade pela inserção de dados falsos ou incorretos introduzidos por seus usuários. </p>
<p>2.6 Depois de efetuado o cadastro, o usuário está apto a usufruir dos benefícios e serviços oferecidos pelo Imooby. </p>
<p>2.7 As informações, coletadas automaticamente pelo site do Banco Central do Brasil ou fornecidas pelo usuário do site, são registradas e armazenadas em nossos bancos de dados, observados os necessários padrões de segurança, de confidencialidade e de integridade.</p>
<h4>3. DOS COOKIES E WEB BEACONS</h4>
<p>3.1 A utilização de cookies pelo Imooby objetiva facilitar a navegação e a adequação do site às preferências dos usuários. Essa utilização não visa monitorar ou identificar as ações dos usuários. É importante ressaltar que o usuário pode, a qualquer momento, utilizar recursos do seu navegador para bloquear a instalação dos cookies ou para informar quando estão ativados. Isto, no entanto, poderá alterar a forma de alteração com o Imooby, incluindo mas não se limitando a impossibilidade de realizar login de acesso ao site. </p>
<p>3.2 Os web beacons, utilizadas em combinação com os cookies, podem estar presentes em páginas da internet e permitem que um site consiga coletar ou transferir informações para o usuário, no intuito de personalizar o site e serviços oferecidos. </p>
<h4>4. ENDEREÇO IP</h4>
<p>4.1 O endereço IP (Internet Protocol - este endereço é um número único atribuído a cada computador conectado à Internet) e outros dados advindos da conexão com o seu computador são utilizados para reunir uma série de informações, para que seja verificada a forma como os usuários utilizam o Imooby. </p>
<h4>5. SEGURANÇA</h4>
<p>5.1 Nenhuma transmissão de dados na internet é 100% segura. Sendo assim, embora o Imooby faça o possível para proteger suas informações pessoais, não é possível garantir a segurança de todas as informações fornecidas pelos usuários. É uma decisão pessoal a utilização dos serviços nessas condições.</p>
<p>5.2 O Imooby não será responsável por interceptações ilegais ou violação de seus sistemas ou bases de dados por pessoas não autorizadas ou ainda pela indevida utilização da informação obtida por estes meios. </p>
<p>5.3 O Imooby sugere que nenhuma informação bancária e/ou sobre cartões de crédito seja encaminhada para anunciantes cujo conhecimento deu-se pela internet. Caso isto ocorra, a responsabilidade por quaisquer consequências será única e exclusivamente do usuário que forneceu as informações. </p>
<h4>6. DISPOSIÇÕES GERAIS DE USO</h4>
<p>6.1 O Imooby se responsabiliza pela informação clara e transparente de seus conteúdos ao usuário. 

<p>6.2 Em caso de alterações ou atualizações dos Dados do Usuário, o Imooby reserva-se o direito de conservar os dados originais por motivos de segurança e controle de fraudes.

<p>6.3 O Imooby não será responsável pelo uso que qualquer Usuário ou outra pessoa puderem fazer da informação públicas expostas no site.</p>

<p>6.4 O Imooby reserva-se o direito de vender, transferir ou compartilhar qualquer fração de seus ativos, incluindo Dados e Conteúdos de Usuários, em caso de fusão, aquisição ou venda de ativos ou em caso de falência.</p>

<p>6.5 O Imooby cumpre todas as leis, normas e regulamentos aplicáveis vigentes, em especial a <a href="http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2014/lei/l12965.htm" target="_BLANK">Lei 12.965/2014</a>. </p>

<p>6.6 Esta Política de Privacidade é aplicável apenas quando o usuário está acessando e usando o Imooby e uma vez encaminhado a outro portal, o usuário estará sujeito às políticas desse outro portal, sobre a qual o site não tem qualquer controle ou relação.</p>

<h4>7. ALTERAÇÕES À POLÍTICA DE PRIVACIDADE</h4>
<p>7.1 Continuaremos a avaliar esta Política de Privacidade com vistas ao acompanhamento das mudanças das necessidades dos usuários, do aprimoramento das tecnologias e do desenvolvimento de novas ofertas de serviço, podendo ocorrer alterações neste documento, na mesma proporção. Reservamo-nos ao direito de alterar esta Política de Privacidade a qualquer momento, sem aviso prévio, motivo pelo qual recomendamos revê-la com frequência. </p>

<h4>8. CONTATO</h4>
<p>8.1 Quaisquer dúvidas com relação à nossa política de privacidade podem ser esclarecidas entrando em contato conosco pelo e-mail: <a href="contato@imooby.com">contato@imooby.com</a>. </p>

<i>Última atualização: 04 de agosto de 2017.</i>

</div>
                    <!--========== END PAGE LAYOUT ==========-->


                    <!--========== FOOTER ==========-->
                    @include('site.layouts.institucional.footer')
                    <!--========== END FOOTER ==========-->
                    @endsection
                    @section('scripts_content')

                    @endsection