    <div class="form-group">
        {!! Form::label('code', 'Código:') !!}
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('value', 'Valor:') !!}
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
        
    </div>
    <div class="form-group">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    </div>