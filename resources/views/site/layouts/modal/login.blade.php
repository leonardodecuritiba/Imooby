<!-- Modal logar -->
<div id="modal_logar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="col-md-12 text-center fonte_cadastrar">FAÇA SEU LOGIN!</div>
                </div>
                <div class="row conteudo_modal">
                    {{Form::open(['route' => 'login', 'method' => 'POST'])}}
                    <div class="col-md-6">
                        Preencha os campos abaixo:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control campos" placeholder="E-mail" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" class="form-control campos" placeholder="Senha"
                                   required>
                        </div>
                        <div class="text-center" style="margin-top: 10px;">
                            <a href="" data-toggle="modal" data-target="#modal_esqueci"
                               style="color: #db4437; text-decoration: underline; font-weight: bold;">Esqueci a minha
                                senha</a>
                        </div>
                        <input type="submit" class="btn btn-success botao_enviar btn-block btn-lg" value="ENTRAR">
                    </div>
                    {!! Form::close() !!}
                    @include('site.layouts.modal.socialnet')
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 text-center footer_final">
                        Ainda não tem sua conta? <a href="" data-dismiss="modal" data-toggle="modal"
                                                    data-target="#modal_cadastrar">cadastre-se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>