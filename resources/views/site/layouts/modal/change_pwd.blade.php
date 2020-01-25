<!-- Modal Cadastrar Imóvel -->
<div id="modal_alterar_senha" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="color: #fff; background-color: #00A7EC">
                <div class="row">
                    {!! Form::open(['route' => 'profile.new_pwd','method' => 'POST']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="col-md-12 fonte_cadastrar" style="margin-bottom: 10px; margin-top: -10px;">
                        <h2 class="text-center">Alterar Senha</h2>
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight: bold;">Digite a nova senha</label>
                        <input type="password" name="password" class="form-control" placeholder="Digite a nova senha"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight: bold;">Repita a nova senha</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Repita a nova senha" required>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <button class="btn btn-warning pull-right" style="font-weight: bold;">Alterar Senha</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>