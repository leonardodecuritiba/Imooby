<div class="modal fade" id="modal_confirmar_agendamento" role="dialog" aria-labelledby="contactLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="contactLabel">Agendar Visita</h4>
            </div>
            {{Form::open(['route'=>['profile.confirm_schedule',$visit->id], 'class'=>'contactForm'])}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cfItem">
                        <input type="text" placeholder="Dia" name="date_time" class="form-control" required>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cfItem">
                        <textarea placeholder="Mensagem" name="visitor_message" maxlength="200" rows="5" class="form-control"
                                  required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-round btn-green" style="border-radius: 0px;">Enviar</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>