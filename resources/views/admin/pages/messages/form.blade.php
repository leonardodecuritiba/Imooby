<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome: </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="name" type="text" maxlength="50" class="form-control" disabled
               value="{{isset($Contato)?$Contato->nome:''}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Email: </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="email" type="text" maxlength="50" class="form-control" disabled
               value="{{isset($Contato)?$Contato->email:''}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Telefone: </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="phone" type="text" class="form-control" disabled
               value="{{isset($Contato)?$Contato->telefone:''}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Assunto: </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="subject" type="text" class="form-control" disabled
               value="{{isset($Contato)?$Contato->assunto:''}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Mensagem: </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <textarea class="form-control" rows="8" name="body"
                  disabled>{{isset($Contato)?$Contato->mensagem:''}}</textarea>
    </div>
</div>