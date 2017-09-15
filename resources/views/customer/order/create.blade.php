@extends('app')
@section('content')
<div class="container">
    <h3>Novo pedido</h3>
    @include('errors._check')
    
    
    <div class="form-group">
        
        <p ><strong>Total R$ </strong><strong id="total-checkout">0,00</strong></p>
        
        <form class="form-inline" action="" onsubmit="return false">
                <label>
                    Item:
                    <select class="form-control" id="new-item-id">
                        <option value="0" data-price="">Escolha</option>
                        @foreach($products as $p)
                        <option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }} &bull; R$ {{ $p->price }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    Quantidade:
                    <input type="number" id="new-item-qtd" value="1" class="form-control" />
                </label>
            <button id="new-item-button" class="btn btn-primary" type="button">Adicionar</button>
        </form>
        <p id="new-item-error" class="text-danger"></p>
        <br />
        <h3 class="title">Items adicionados ao pedido</h3>
        {!! Form::open(['route' => 'customer.order.store', 'class' => 'form']) !!}
        <table class="table table-bordered" id="item-list">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="form-group">
            {!! Form::submit('Salvar pedido', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('post-script')
<script>
    var itemIndex = 0;
    var totalCheckout = 0;
    $('#new-item-button').click(function() {
        $('#new-item-error').empty();
        
        var newItemId = $('#new-item-id').val(),
            newItemName = $('#new-item-id option:selected').text(),
            newItemPrice = $('#new-item-id option:selected').attr('data-price'),
            newItemQtd = $('#new-item-qtd').val();
            
        if (!isNaN(newItemId) && !isNaN(newItemQtd)) {
            if (newItemId > 0 && newItemQtd > 0) {
                if (document.getElementById('new-item-row- ' + newItemId)) {
                    console.log(newItemId)
                    var newItemQtdOld = $('#new-item-qtd-' + newItemId).val();
                    $('#new-item-qtd-' + newItemId).val(newItemQtd);
                    totalCheckout = totalCheckout - (newItemQtdOld * newItemPrice) + (newItemQtd * newItemPrice);
                    $('#new-item-row-total-' + newItemId).text(newItemQtd * newItemPrice);
                    $('#new-item-row-qtd-' + newItemId).text(newItemQtd);
                    
                    $('#new-item-error').html('O item escolhido já existia no pedido e o mesmo foi atualizado.');
                } else {
                    html =  '';
                    html += '<tr id="new-item-row-' + newItemId + '">';
                    html += '<td>' + newItemName + '</td>';
                    html += '<td id="new-item-row-qtd-' + newItemId + '">' + newItemQtd + '</td>';
                    html += '<td>' + newItemPrice + '</td>';
                    html += '<td id="new-item-row-total-' + newItemId + '">' + (newItemQtd * newItemPrice) + '</td>';
                    html += '<td>';
                    html += '   <input type="hidden" name="items[' + itemIndex + '][product_id]" value="' + newItemId + '" />';
                    html += '   <input type="hidden" name="items[' + itemIndex + '][qtd]" id="new-item-qtd-' + newItemId + '" value="' + newItemQtd + '" />';
                    html += '   <input type="hidden" name="items[' + itemIndex + '][name]" value="' + newItemName + '" />';
                    html += '   <button class="btn btn-danger" onclick="removeItem(' + newItemId + ', ' + (newItemQtd * newItemPrice)+ ')">Remover</button>';
                    html += '</td>';
                    html += '</tr>';

                    $('#item-list tbody').append(html);

                    itemIndex++;
                    totalCheckout += (newItemQtd * newItemPrice);
                }
                
                $('#total-checkout').text(totalCheckout);
                
                $('#new-item-qtd').val(1);
                $('#new-item-id').val(0);
            } else {
                $('#new-item-error').html('Item e/ou quantidade inválidos.');
            }
        } else {
                $('#new-item-error').html('Item e/ou quantidade inválidos.');
        }
    });
    
    function removeItem(id, total) {
       $('#new-item-row-' + id).remove();
       totalCheckout -= total;
       $('#total-checkout').text(totalCheckout.toFixed(2));
    }
</script>
@endsection