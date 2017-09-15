@extends('app')
@section('content')
<div class="container">
    <h3>Editar cliente {{$client->user->name}}</h3>
    @include('errors._check')
    {!! Form::model($client, ['route' => ['admin.clients.update', $client->id]]) !!}
    @include('admin.clients._form')
    {!! Form::close() !!}
</div>
@endsection

