@extends('app')
@section('content')
<div class="container">
    <h3>Novo produto</h3>
    @include('errors._check')
    {!! Form::open(['route' => 'admin.products.store']) !!}
    @include('admin.products._form')
    {!! Form::close() !!}
</div>
@endsection

