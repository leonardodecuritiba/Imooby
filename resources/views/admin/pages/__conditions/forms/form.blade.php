<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Ordem: <span class="required">*</span></label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="order" type="number" class="form-control" required
               value="{{(isset($Data->order))?$Data->order:old('order')}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Título: <span class="required">*</span></label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input name="title" type="text" maxlength="100" class="form-control" required
               value="{{(isset($Data->title))?$Data->title:old('title')}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Descrição: <span class="required">*</span></label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <textarea name="description" rows="10" maxlength="1000" class="form-control"
                  required>{{(isset($Data->description))?$Data->description:old('description')}}</textarea>
    </div>
</div>