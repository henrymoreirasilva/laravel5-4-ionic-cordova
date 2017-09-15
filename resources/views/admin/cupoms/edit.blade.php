@extends('app')
@section('content')
<div class="container">
    <h3>Editar cupom {{$cupom->code}}</h3>
    @include('errors._check')
    {!! Form::model($cupom, ['route' => ['admin.cupoms.update', $cupom->id]]) !!}
    @include('admin.cupoms._form')
    {!! Form::close() !!}
</div>
@endsection

