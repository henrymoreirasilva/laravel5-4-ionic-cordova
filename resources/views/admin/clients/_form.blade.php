    <div class="form-group">
        {!! Form::label('name', 'Nome:') !!}
        {!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('email', 'E-mail:') !!}
        {!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('phone', 'Telefone:') !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('address', 'Endereço:') !!}
        {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('city', 'Cidade:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('state', 'Estado:') !!}
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
        
        {!! Form::label('zipcode', 'CEP:') !!}
        {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
        
    </div>
    <div class="form-group">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    </div>