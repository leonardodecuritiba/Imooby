<!-- Modal contato -->
<div id="modal_contato" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #fff;">
            <div class="row" style="padding: 0px; margin: 0px;">
                <div class="col-md-6" style="background-color: #00a7ec; padding: 20px;">
                    <div class="row">
                        <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                            <a type="button" class="close" data-dismiss="modal">&times;</a>
                        </div>
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <p style="color: #fff">ENVIE SUA<BR><b>MENSAGEM</b></p>
                        </div>
                        {!! Form::open(['route' => 'contact','method' => 'POST']) !!}
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="input-group">
                                    <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                                class="fa fa-user"></i></span>
                                <input type="text" name="name" class="form-control campos"
                                       placeholder="Insira o seu nome" required>
                            </div>
                            <div class="input-group" style="margin-top: 10px;">
                                    <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                                class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control campos"
                                       placeholder="Insira o seu e-mail" required>
                            </div>
                            <div class="input-group" style="margin-top: 10px;">
                                    <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                                class="fa fa-mobile"></i></span>
                                <input type="text" name="phone" class="form-control campos"
                                       placeholder="Insira o seu telefone/celular">
                            </div>
                            <textarea style="margin-top: 10px;" name="message" class="form-control campos" rows="4"
                                      placeholder="Digite a sua mensagem" maxlength="500" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-default btn-lg btn-block btn_enviar" href="">ENVIAR</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-6 text-center" style="background-color: #fff; padding: 20px;">
                    <div style="margin-bottom: 30px;">
                        <div class="col-md-12 hidden-xs">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="row linha_contato" style="margin-top: 105px;">
                        <div class="col-md-offset-2 col-md-2 col-xs-2">
                            <img src="assets_site/img/chat.png" style="width: 100%;">
                        </div>
                        <div class="col-md-8 col-xs-10 text-left">
                            <label class="fonte_texto_contato">CHAT</label>
                            <div style="margin-top: -5px;">
                                <label class="cor_texto">Atendimento online</label>
                            </div>
                        </div>
                    </div>
                    <div class="row linha_contato">
                        <div class="col-md-offset-2 col-md-2 col-xs-2">
                            <img src="assets_site/img/contato.png" style="width: 100%;">
                        </div>
                        <div class="col-md-8 col-xs-10 text-left">
                            <label class="fonte_texto_contato">E-MAIL</label>
                            <div style="margin-top: -5px;">
                                <label class="cor_texto">CONTATO@IMOOBY.COM.BR</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-12">
                            <a href="" target="_blank">
                                <img src="assets_site/img/facebook.png">
                            </a>
                            <a href="" target="_blank">
                                <img src="assets_site/img/twitter.png" style="margin-left: 20px;">
                            </a>
                            <a href="" target="_blank">
                                <img src="assets_site/img/printerest.png" style="margin-left: 20px;">
                            </a>
                            <a href="" target="_blank">
                                <img src="assets_site/img/instagram.png" style="margin-left: 20px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            