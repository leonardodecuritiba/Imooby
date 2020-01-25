<!-- Modal Cadastrar -->
<div id="modal_cadastrar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="col-md-12 text-center fonte_cadastrar">CADASTRE-SE AGORA!</div>
                </div>
                <div class="row conteudo_modal">
                    {!! Form::open(['route' =>'clients.begin', 'method' => 'POST']) !!}
                    <div class="col-md-6">
                        Preencha os campos abaixo:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="name" class="form-control campos" placeholder="Nome" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control campos" placeholder="E-mail" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" class="form-control campos" placeholder="Senha"
                                   required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password_confirmation" class="form-control campos"
                                   placeholder="Confirmar Senha" required>
                        </div>
                        {{--<div class="div_checkbox">--}}
                        {{--<input type="checkbox">--}}
                        {{--<texto>Assinar Newsletter</texto>--}}
                        {{--</div>--}}
                        <input type="submit" class="btn btn-success botao_enviar btn-block btn-lg" value="CADASTRAR">
                    </div>
                    {!! Form::close() !!}
                    @include('site.layouts.modal.socialnet')
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 text-center footer_final">
                        Já é cadastrado? <a href="" data-toggle="modal" data-target="#modal_logar" data-dismiss="modal"
                                            onclick="">login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>