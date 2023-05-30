@extends('layouts.index')
@section('content')

@foreach ($data as $da)
<p>{{$da->name_hotel}}</p>

<p>Номера в отеле:</p>
@foreach ($room as $data)
<a href="{{route('show.room', [$da->id_hotel, $data->type_room])}}">{{$data->type_room}}</a>
<p>{{$data->type_food}}</p>
@if (Auth::user()->type_user == 'менеджер')
<a href="{{route('delete.room', [$da->id_hotel, $data->type_room])}}">удалить</a>
@endif
@endforeach
@endforeach
<form method="post" action="{{route('create.comment', $da->id_hotel)}}">
   @csrf
   <label>Добавить отзыв</label>
   <input name="id_hotel" hidden="{{$da->id_hotel}}">
   <textarea type="text" name="comment" placeholder="Оставьте отзыв"></textarea>
   <button type="submit">Добавить</button>
</form>



@foreach ($comment as $data)
<p>{{$data->name}}</p>
<p>{{$data->comment}}</p>
<p>{{$data->date_comment}}</p>
@endforeach

@endsection