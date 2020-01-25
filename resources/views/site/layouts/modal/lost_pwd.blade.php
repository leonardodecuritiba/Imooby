<!-- Modal esqueci -->
<div id="modal_esqueci" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #00a7ec;">
            <div class="modal-body" style="background-color: #00a7ec;">
                <div class="row">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="col-md-12 text-center fonte_cadastrar" style="color: #fff">ESQUECI MINHA SENHA</div>
                </div>
                <div class="row conteudo_modal">
                    {!! Form::open(['route' =>'password.email', 'method' => 'POST']) !!}
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <p style="color: #fff">Insira seu e-mail que enviaremos um link para recuperação da senha.</p>
                    </div>
                    <div class="col-md-offset-2 col-md-8" style="margin-bottom: 10px;">
                        <div class="input-group">
                                <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                            class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control campos" placeholder="E-mail" required>
                        </div>
                    </div>
                    <div class="col-md-offset-2 col-md-4">
                        <a class="btn btn-default btn-lg btn-block" href="" class="close" data-dismiss="modal"
                           style="color: #fff; background-color: transparent; border-color: transparent; border-radius: 0px;"><i
                                    class="fa fa-arrow-left"></i> VOLTAR</a>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-default btn-lg btn-block"
                                style="background-color: #fff; color: #00a7ec; border-radius: 0px; font-weight: bold;">
                            ENVIAR
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>