@extends('app')
@section('content')
<div class="container">
    <h3>Novo cupom</h3>
    @include('errors._check')
    {!! Form::open(['route' => 'admin.cupoms.store']) !!}
    @include('admin.cupoms._form')
    {!! Form::close() !!}
</div>
@endsection

