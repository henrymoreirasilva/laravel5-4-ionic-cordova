@extends('app')
@section('content')
<div class="container">
    <h3>Meus pedidos</h3>
    <p><a href="{{ route('customer.order.create') }}" class="btn btn-default">Novo pedido</a></p>
    @include('errors._check')
    
    <table class="table table-bordered" id="item-list">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>
                    {{$order->id}}
                </td>
                <td>
                    {{$order->created_at}}
                </td>
                <td>
                    {{$order->total}}
                </td>
                <td>
                    {{$order->status}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $orders->render() !!}
</div>
@endsection