@extends('layouts.app')

@section('content')

 <h1>メッセージ新規作成ページ</h1>

<div claass='row'>
    <div class='col-xs-12'>
    <div class='col-sm-offset-2 col-sm-8'>
    <div class='col-md-offset-2 col-md-8'>
    <div class='col-lg-offset-3 col-lg-6'>
    {!! Form::model($tasklist, ['route' => 'tasklists.store']) !!}
     
     <div class='form-group'>
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status', null, ['class' => 'form-control']) !!}
      </div>
    

    <div class='form-group'>
        {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content', null, ['class' => 'form-control']) !!}
    </div>

        {!! Form::submit('投稿', ['class' =. 'btn btn-primary']) !!}

    {!! Form::close() !!}
    
    </div>
    </div>
    </div>
    </div>
    
</div>

@endsection