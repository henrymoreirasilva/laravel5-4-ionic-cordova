@extends('app')
@section('content')
<div class="container">
    <h3>Pedido nº #{{$order->id}}</h3>
    <h4>Cliente: {{$order->client->user->name}}</h4>
    <h5>Data: {{$order->created_at}} &bull; Valor: R$ {{$order->total}}</h5>
    <p>
        Entregar em:<br />
        {{$order->client->address}}<br />
        {{$order->client->city}} &bull; {{$order->client->state}}<br />
        {{$order->client->zipcode}}
    </p>
    @include('errors._check')
    {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}
    @include('admin.orders._form')
    {!! Form::close() !!}
</div>
@endsection

