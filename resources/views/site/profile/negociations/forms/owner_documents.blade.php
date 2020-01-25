<div class="row {{($i==0)?'esconda':''}}" style="color: #777; margin-top: 30px;">
    <div class="text-right">
        <button class="btn btn-danger btn-xs pull-right" onclick="remover_campos(this)"><i class="fa fa-times"></i>
            Remover
        </button>
    </div>
</div>
<div class="row" style="color: #777; margin-top: 30px;">
    <div class="col-md-offset-3 col-md-3">
        <label class="negrito">Nome</label>
        <input type="text" class="form-control campos" name="document[0][name]" max="100"
               value="{{($renter_document != NULL) ? $renter_document->name : old('name')}}" required>
    </div>
    <div class="col-md-3">
        <label class="negrito">E-mail</label>
        <input type="text" class="form-control campos" name="document[0][email]" max="60"
               value="{{($renter_document != NULL) ? $renter_document->email : old('email')}}" required>
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3">
                            <label class="negrito">Código IPTU do Imóvel:</label>
                            <input type="text" id="iptu_code" class="form-control" name="iptu_code" value="{{($renter_document!=NULL) ? $renter_document->iptu_code : old('iptu_code')}}" required>
                            </div>
                            <div class="col-md-3">
                            <label class="negrito">Número da Matrícula:</label>
                            <input type="text" id="iptu_registration" class="form-control" name="iptu_registration" value="{{($renter_document!=NULL) ? $renter_document->iptu_registration : old('iptu_registration')}}" required>
                            </div>
                        </div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-2">
        <label class="negrito">Cpf</label>
        <input type="text" id="cpf" class="form-control show-cpf" name="document[0][cpf]" max="16"
               value="{{($renter_document != NULL) ? $renter_document->cpf : old('cpf')}}" required>
    </div>
    <div class="col-md-2">
        <label class="negrito">Telefone</label>
        <input type="text" id="phone" class="form-control show-telefone" name="document[0][phone]" max="11"
               value="{{($renter_document != NULL) ? $renter_document->phone : old('phone')}}" required>
    </div>
    <div class="col-md-2">
        <label class="negrito">Celular</label>
        <input type="text" id="cellphone" class="form-control show-celular" name="document[0][cellphone]" max="11"
               value="{{($renter_document != NULL) ? $renter_document->cellphone : old('cellphone')}}" required>
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-3">
        <label class="negrito">Natureza da Renda</label>
        <select class="form-control campos" name="document[0][income_nature]" required>
            <option value="">Selecionar</option>
            <option value="Trabalho" {{((($renter_document != NULL) && ($renter_document->income_nature == "Trabalho")) || (old('income_nature') == "Trabalho")) ? 'selected' : ''}}>
                Trabalho
            </option>
            <option value="Trabalho2" {{((($renter_document != NULL) && ($renter_document->income_nature == "Trabalho2")) || (old('income_nature') == "Trabalho2")) ? 'selected' : ''}}>
                Trabalho2
            </option>
            <option value="Trabalho3" {{((($renter_document != NULL) && ($renter_document->income_nature == "Trabalho3")) || (old('income_nature') == "Trabalho3")) ? 'selected' : ''}}>
                Trabalho3
            </option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="negrito">Rendimento Bruto Mensal</label>
        <input type="text" class="form-control campos show-valor" name="document[0][gross_income]"
               value="{{($renter_document != NULL) ? $renter_document->gross_income : old('gross_income')}}" required>
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-3">
        <label class="negrito">Motivo da Locação</label>
        <select class="form-control campos" name="document[0][reason]" required>
            <option value="">Selecione</option>
            <option value="Residencial" {{((($renter_document != NULL) && ($renter_document->reason == "Residencial")) || (old('civil_status') == "Residencial")) ? 'selected' : ''}}>
                Residencial
            </option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="negrito">Estado Cívil</label>
        <select class="form-control campos" name="document[0][civil_status]" required>
            <option value="">Selecione</option>
            <option value="Casado" {{((($renter_document != NULL) && ($renter_document->civil_status == "Casado")) || (old('civil_status') == "Casado")) ? 'selected' : ''}}>
                Casado
            </option>
            <option value="Solteiro" {{((($renter_document != NULL) && ($renter_document->civil_status == "Solteiro")) || (old('civil_status') == "Solteiro")) ? 'selected' : ''}}>
                Solteiro
            </option>
            <option value="Divorciado" {{((($renter_document != NULL) && ($renter_document->civil_status == "Divorciado")) || (old('civil_status') == "Divorciado")) ? 'selected' : ''}}>
                Divorciado
            </option>
            <option value="Separado" {{((($renter_document != NULL) && ($renter_document->civil_status == "Separado")) || (old('civil_status') == "Separado")) ? 'selected' : ''}}>
                Separado
            </option>
            <option value="Viúvo" {{((($renter_document != NULL) && ($renter_document->civil_status == "Viúvo")) || (old('civil_status') == "Viúvo")) ? 'selected' : ''}}>
                Viúvo
            </option>
        </select>
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-4">
        <label class="negrito">RG, CNH ou RNE
            <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina>
        </label>
        <input type="file" class="form-control"
               name="document[0][doc_link]" {{($renter_document != NULL) ? '' : 'required'}}>
    </div>
    <div class="col-md-2">
        @if($renter_document != NULL)
            <img src="{{$renter_document->getDocImage()}}" style="width: 100%;">
        @else
            <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
        @endif
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-4">
        <label class="negrito">CPF
            <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina>
        </label>
        <input type="file" class="form-control"
               name="document[0][cpf_link]" {{($renter_document != NULL) ? '' : 'required'}}>
    </div>
    <div class="col-md-2">
        @if($renter_document != NULL)
            <img src="{{$renter_document->getCpfImage()}}" style="width: 100%;">
        @else
            <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
        @endif
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-4">
        <label class="negrito">Comprovante de Residência
            <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina>
        </label>
        <input type="file" class="form-control"
               name="document[0][address_proof_link]" {{($renter_document != NULL) ? '' : 'required'}}>
    </div>
    <div class="col-md-2">
        @if($renter_document != NULL)
            <img src="{{$renter_document->getAddressProofImage()}}" style="width: 100%;">
        @else
            <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
        @endif
    </div>
</div>
<hr>
<div class="row" style="color: #777;">
    <div class="col-md-offset-3 col-md-4">
        <label class="negrito">Holerite, Imposto de Renda ou DECORE
            <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina>
        </label>
        <input type="file" class="form-control"
               name="document[0][income_proof_link]" {{($renter_document != NULL) ? '' : 'required'}}>
    </div>
    <div class="col-md-2">
        @if($renter_document != NULL)
            <img src="{{$renter_document->getIncomeProofImage()}}" style="width: 100%;">
        @else
            <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
        @endif
    </div>
</div>
<hr style="border-bottom: 2px solid #00A7EC;">