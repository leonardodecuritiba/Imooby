<div class="figure">
    <img src="{{$property->getThumbMainPhoto()}}" alt="image">
    <div class="figCaption">
        <div>{{$property->priceTotalReal()}}</div>
    </div>
    <div class="figView"><span class="icon-eye"></span></div>
</div>
<h2>{{$property->name}}</h2>
<div class="cardAddress"><span class="icon-pointer"></span> {{$property->address->getFullAddress()}}</div>
<ul class="cardFeat">
    <li><span class="fa fa-moon-o"></span> {{$property->bedroom_n}}</li>
    <li><span class="icon-drop"></span> {{$property->bathroom_n}}</li>
    <li><span class="icon-frame"></span> {{$property->getInternalArea()}}</li>
    <li><span class="fa fa-heart"></span> {{$property->countFavorites()}}</li>
</ul>
<div class="clearfix"></div>