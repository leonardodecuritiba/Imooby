@if(isset($Data))
    <div class="form-group">
        <div class="col-md-offset-4 col-sm-offset-4 col-xs-4 col-md-4 col-sm-4 col-xs-12">
            <div class="peca_image">
                <img src="{{$Data->getPhoto()}}" width="70%"/>
            </div>
        </div>
    </div>
    <div class="ln_solid"></div>
@endif
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome: <span class="required">*</span></label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="name" type="text" maxlength="100" class="form-control" required
               value="{{(isset($Data->name))?$Data->name:old('name')}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Email: <span class="required">*</span></label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="email" type="email" class="form-control" required
               value="{{(isset($Data))?$Data->user->email:old('email')}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Senha: <span class="required">*</span></label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        @if(!isset($Data))
            <input name="password" type="password" maxlength="60" class="form-control" required>
        @else
            <a class="btn btn-primary" data-toggle="modal" data-target="#modalPWD">Atualizar Senha</a>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Foto </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="file" class="form-control" name="photo">
    </div>
</div>

