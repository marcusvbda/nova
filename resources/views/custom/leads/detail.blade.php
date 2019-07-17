<div class="content">
    <ul>
        <li><b>Telefone :</b> {{$lead->phone}}</li>
        <li><b>Celular :</b> {{$lead->cell}}</li>
        <li><b>Cidade :</b> {{$lead->city}}</li>
        <li><b>Estado :</b> {{$lead->state}}</li>
        @foreach($customFields as $field)
            <li><b>{{$field->name}} :</b> {{@$lead->custom_values[$field->id]}}</li>
        @endforeach
        <li><b>Tags :</b> 
            @foreach($lead->tags as $tag)
                <span>{{$tag->name}}</span>
            @endforeach
        </li>
    </ul>
</div>