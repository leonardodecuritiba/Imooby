<div class="profile_img">
    <a href="{{route($Page->link.'.show',$Data->id)}}"><img width="100%" src="{{$Data->getPhoto()}}" alt="Avatar"></a>
</div>
<h4>{{$Data->name}}</h4>
<ul class="list-unstyled user_data">
    <li>
        <i class="fa fa-map-marker user-profile-icon"></i> {{implode(', ',$Data->getResumedAddress())}}
    </li>
    <li class="m-top-xs">
        <i class="fa fa-phone user-profile-icon"></i>
        <span class="show-telefone">{{$Data->contact->phone}}</span>
    </li>
    <li class="m-top-xs">
        <i class="fa fa-envelope-o user-profile-icon"></i>
        <a href="#">{{$Data->user->email}}</a>
    </li>
    <li class="m-top-xs">
        <i class="fa fa-calendar-o user-profile-icon"></i>
        <a href="#">{{$Data->created_at}}</a>
    </li>
</ul>