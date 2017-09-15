    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        {!! Form::select('status', $listStatus, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('deliveryman', 'Entregador:') !!}
        {!! Form::select('user_deliveryman_id', $deliverymen, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    </div>