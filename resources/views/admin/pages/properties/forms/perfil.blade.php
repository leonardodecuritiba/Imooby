<div class="profile_img">
    <a href="{{route($Page->link.'.show',$Client->id)}}"><img width="100%" src="{{$Client->getPhoto()}}"
                                                              alt="Avatar"></a>
</div>
<h4>{{$Client-name}}</h4>
{{--<ul class="list-unstyled user_data">--}}
{{--<li>--}}
{{--<i class="fa fa-map-marker user-profile-icon"></i> {{implode(', ',$Client->getEnderecoResumido())}}--}}
{{--</li>--}}
{{--<li class="m-top-xs">--}}
{{--<i class="fa fa-phone user-profile-icon"></i>--}}
{{--<span class="show-telefone">{{$Client->contato->telefone}}</span>--}}
{{--</li>--}}
{{--<li class="m-top-xs">--}}
{{--<i class="fa fa-envelope-o user-profile-icon"></i>--}}
{{--<a href="#" >{{$Client->email_orcamento}}</a>--}}
{{--</li>--}}
{{--<li class="m-top-xs">--}}
{{--<i class="fa fa-calendar-o user-profile-icon"></i>--}}
{{--<a href="#">{{$Client->created_at}}</a>--}}
{{--</li>--}}
{{--</ul>--}}