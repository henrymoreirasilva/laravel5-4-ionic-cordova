@extends('app')
@section('content')
<div class="container">
    <h3>Cupoms</h3>
    <a href="{{ route('admin.cupoms.create') }}" class="btn btn-default">Novo cupom</a>
    <table class="table">
        <thead>
            <tr><th>ID</th><th>Código</th><th>Nome</th><th>Ação</</tr>
        </thead>
        <tbody>
        @foreach($cupoms as $cupom)
        <tr><td>{{$cupom->id}}</td><td>{{$cupom->code}}</td><td>{{$cupom->value}}</td><td><a href="{{ route('admin.cupoms.edit', ['id' => $cupom->id]) }}" class="btn btn-default btn-sm">Editar</a></td></tr>
        @endforeach
        </tbody>
    </table>
    {!! $cupoms->render() !!}
</div>
@endsection

