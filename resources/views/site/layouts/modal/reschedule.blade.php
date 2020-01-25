<div class="modal fade" id="modal_reagendar_visita" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="contactLabel">Reagendar Visita</h4>
            </div>
            {{Form::open(['route'=>['schedule.refresh', 'XX'], 'class'=>'contactForm'])}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label for="">Data:</label>
                        <input type="text" placeholder="Selecione uma data" name="date" class="available-dates form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label for="">Horário:</label>
                    <select name="time" class="available-times form-control" required="required">
                        <option>Selecione um horário</option>
                    </select>
                    </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top:15px;">
                        <label for="">Mensagem:</label>
                        <textarea name="visitor_message" style="resize:none" placeholder="Deixe uma mensagem para o proprietário" class="form-control" rows="7" maxlength="256" required="required"></textarea>
                </div>            
            </div>
            <div class="modal-footer">
                <button class="btn btn-round btn-green" style="border-radius: 0px;">Enviar</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>