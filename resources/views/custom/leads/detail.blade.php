<div class="content">
    <div class="flex">
        <ul>
            <li><b>Telefone :</b> {{$lead->phone}}</li>
            <li><b>Celular :</b> {{$lead->cell}}</li>
            <li><b>Cidade :</b> {{$lead->city}}</li>
            <li><b>Estado :</b> {{$lead->state}}</li>
        </ul>
        <ul>
            <li><b>Data de Entrada  :</b> {{ date('d/m/Y - H:i:s', strtotime($lead->created_at)) }}</li>
            <li><b>Última Conversão  :</b> {{ date('d/m/Y - H:i:s', strtotime($lead->updated_at)) }}</li>
            <li><b>Definição de Status  :</b> {{ $lead->status->definition->name }}</li>
            @foreach($customFields as $field)
                <li><b>{{$field->name}} :</b> {{@$lead->custom_values[$field->id]}}</li>
            @endforeach
        </ul>
        <ul>
            <li><b>Tags :</b> 
                @foreach($lead->tags as $tag)
                    <span>{{$tag->name}}</span>
                @endforeach
            </li>
        </ul>
    </div>
</div>