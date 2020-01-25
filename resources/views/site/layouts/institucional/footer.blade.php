<div style="background-color: #00a7ec; padding-top: 80px; padding-bottom: 80px; color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-bottom: 70px;">
                <h1 style="color: #fff; font-weight: normal;">Encontre aqui <b>seu imóvel ideal :)</b></h1>
                <a href="{{ route('lista-de-imoveis') }}" style="color: #ececec;"">Lista de todos os imóveis</a>
            </div>
            <div class="col-md-3">
                <titulo>Por Cidade</titulo>
                <div class="cidades text-left">
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Belo+Horizonte+-+MG%2C+Brasil&lat=-19.9166813&lng=-43.9344931">Belo Horizonte</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Bel%C3%A9m+-+PA%2C+Brasil&lat=-1.4557549&lng=-48.49017989999999">Belém</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Bras%C3%ADlia+-+DF%2C+Brasil&lat=-15.7942287&lng=-47.882165799999996">Brasília</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Curitiba+-+PR%2C+Brasil&lat=-25.4289541&lng=-49.26713699999999">Curitiba</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Fortaleza+-+CE%2C+Brasil&lat=-3.7318616&lng=-38.5266704">Fortaleza</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Goi%C3%A2nia+-+GO%2C+Brasil&lat=-16.68689119999999&lng=-49.264794300000005">Goiânia</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Manaus+-+AM%2C+Brasil&lat=-3.1190275&lng=-60.02173140000002">Manaus</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Porto+Alegre+-+RS%2C+Brasil&lat=-30.0346471&lng=-51.217658400000005">Porto Alegre</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Recife+-+PE%2C+Brasil&lat=-8.0578381&lng=-34.88289689999999">Recife</a><br>
                    <a href="https://www.imooby.com/buscar-imoveis?busca=Rio+de+Janeiro+-+RJ%2C+Brasil&lat=-22.9068467&lng=-43.17289649999998">Rio de Janeiro</a><br>
                </div>
            </div>
            <div class="col-md-3">
                <titulo>Pesquisas Populares</titulo>
                <div class="pesquisas text-left">
                </div>
            </div>
            <div class="col-md-3">
                <titulo>Empresa</titulo>
                <div class="empresa text-left">
                    <a href="{{route('blog.index')}}">Blog</a><br>
                    <a href="{{route('sobre-nos')}}">Sobre nós</a><br>
                    <a href="">Carreiras</a><br>
                    <a href="{{ route('contactus') }}">Fale conosco</a>
                </div>
                <titulo>Como Funciona</titulo>
                <div class="empresa text-left">
                    <a href="{{route('como-funciona-proprietario')}}">Para você proprietário</a><br>
                    <a href="{{route('como-funciona-inquilino')}}">Para você inquilino</a><br>
                </div>
                <titulo>Políticas</titulo>
                <div class="empresa text-left">
                    <a href="{{ route('termos-de-uso') }}">Termos de Uso</a><br>
                    <a href="{{ route('politicas-de-privacidade') }}">Politicas de Privacidade</a>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <img src="{{asset('assets_site/img/logo_branco_200x55.png')}}">
                <p class="descricao_empresa">Desenvolvemos um modelo de negócio inovador com a missão de
                    democratizar o
                    processo de locação de imóveis residenciais, fazendo com que proprietários e inquilinos possam
                    fechar negócio com muito mais segurança, agilidade e economia.</p>
                <div class="row" style="margin-bottom: 20px; margin-top: 20px;">
                    <div class="col-md-12 text-center">
                        <a href="#" class="ficon"><i class="fa fa-facebook" style="font-size: 2em;"></i></a>
                        <a href="#" class="ficon"><i class="fa fa-twitter" style="font-size: 2em;"></i></a>
                        <a href="#" class="ficon"><i class="fa fa-pinterest" style="font-size: 2em;"></i></a>
                        <a href="#" class="ficon"><i class="fa fa-instagram" style="font-size: 2em;"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <img src="{{asset('assets_site/img/google.png')}}" style="width: 100%;">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <img src="{{asset('assets_site/img/store.png')}}" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact -->
<div id="contact" style="padding-top: 20px;">
    <div class="col-md-12 text-center">
        <p>
            {{$_PAGE_TEMPLATE_['main_name']}} CNPJ: {{$_PAGE_TEMPLATE_['main_cnpj']}}<br>
            {{$_PAGE_TEMPLATE_['main_copyright']}}
        </p>
    </div>
</div>
<!-- End Contact -->