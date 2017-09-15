@extends('app')
@section('content')
<div class="container">
    <h3>Pedidios</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente/Data</th>
                <th>Total (R$)</th>
                <th>Itens</th>
                <th>Entregador</th>
                <th>Status</th>
                <th>Ação</td>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->client->user->name}}<br />{{$order->created_at}}</td>
                <td>{{$order->total}}</td>
                <td>
                    <ul>
                    @foreach ($order->items as $item) 
                    <li>{{$item->product->name}}</li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    @if($order->deliveryman)
                        {{$order->deliveryman->name}}
                    @else
                        --
                    @endif
                </td>
                <td>{{$order->status}}</td>
                <td><a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" class="btn btn-default btn-sm">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $orders->render() !!}
</div>
@endsection

