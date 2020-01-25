<div class="modal fade" id="modal_iniciar_negociacao" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="contactLabel">Iniciar Negociação</h4>
            </div>
            {{Form::open(['route'=>'negociation.open', 'class'=>'contactForm'])}}
                <input type="hidden" name="idproperty">
                <div class="modal-body">
                    <p>Deseja iniciar uma negociação?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-round btn-green" style="border-radius: 0px;">Confirmar</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>