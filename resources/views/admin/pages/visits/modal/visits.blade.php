<div class="modal fade" id="modalVisit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-danger">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h2 class="modal-title">Visita (#<b></b>) - <i></i></h2>
            </div>
            <div class="modal-body profile_details">
                <div class="well profile_view">
                    <div class="col-xs-12 cancelation">
                        <div class="">
                            <h2>Cancelamento</h2>
                            <ul class="list-unstyled">
                                <li><b><i class="fa fa-clock-o"></i> Cancelado em: </b><span id="canceled"></span></li>
                                <li><b><i class="fa fa-user"></i> Por: </b><span id="idcanceler"></span></li>
                                <li><b><i class="fa fa-times"></i> Motivo: </b><span id="cancellation_reason"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 property">
                        <div class="right col-xs-3 text-center">
                            <img src="{{asset('assets_admin/imgs/home.png')}}" class="img-circle img-responsive">
                        </div>
                        <div class="perfil left col-xs-9">
                            <h2>Imóvel</h2>
                            <ul class="list-unstyled">
                                <li><b><i class="fa fa-building"></i> Título: </b><span id="owner"></span></li>
                                <li><b><i class="fa fa-money"></i> Preço: </b><span id="price" class="green"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 visitor">
                        <div class="right col-xs-3 text-center">
                            <img src="{{asset('assets_admin/imgs/user.png')}}" class="img-circle img-responsive">
                        </div>
                        <div class="perfil left col-xs-9">
                            <h2>Visitante</h2>
                            <ul class="list-unstyled">
                                <li><b><i class="fa fa-user"></i> Nome: </b><span id="visitor"></span></li>
                                <li id="message">
                                    <b><i class="fa fa-envelope"></i> Mensagem: </b><span></span>
                                </li>
                                <li id="confirmation">
                                    <b><i class="fa fa-check"></i> Confirmado em: </b><span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 owner">
                        <div class="right col-xs-3 text-center">
                            <img src="{{asset('assets_admin/imgs/user.png')}}" class="img-circle img-responsive">
                        </div>
                        <div class="perfil left col-xs-9">
                            <h2>Proprietário</h2>
                            <ul class="list-unstyled">
                                <li><b><i class="fa fa-user"></i> Nome: </b><span id="owner"></span></li>
                                <li id="message">
                                    <b><i class="fa fa-envelope"></i> Mensagem: </b><span></span>
                                </li>
                                <li id="confirmation">
                                    <b><i class="fa fa-check"></i> Confirmado em: </b><span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>