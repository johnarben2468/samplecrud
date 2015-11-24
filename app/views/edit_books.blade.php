
@extends('layouts.main')

@section('title')
    Books Management
@stop

@section('main')



<div class="row">

    @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif

    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'files' => true)) }}
   
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='left'>
                    Edit Book
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="left">
    

                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <input type="hidden" name="id" value="{{$book->id}}">
                            <label>Book Name</label>
                            {{ Form::text('name', $book->name, array('class' => 'form-control  ', 'placeholder' => 'Name','maxlength'=>'255')) }}
                            @if ($errors->has('name')) 
                                <p class="help-block">{{ $errors->first('name') }}</p>  
                            @endif
                        </div>

                        <div class="form-group @if ($errors->has('author')) has-error @endif">
                            <label>Author</label>
                                {{ Form::text('author',$book->author, array('class' => 'form-control  ', 'placeholder' => 'Author','maxlength'=>'255')) }}
                            @if ($errors->has('author')) 
                                <p class="help-block">{{ $errors->first('author') }}</p>  
                            @endif
                        </div>

                        <div class="form-group @if ($errors->has('date')) has-error @endif">
                            <label>Date Published</label>
                                <input name="date" type="date" class="form-control" value="{{$book->date}}">
       
                            @if ($errors->has('date')) 
                                <p class="help-block">{{ $errors->first('date') }}</p>  
                            @endif

                        </div>
                        <div class="form-group <?php if($errors->first('file'))
                              echo 'row has-error has-feedback'?>" >
                              <label>Thumbnail File</label>
                                <input type="file" class="form-control" id="file" name="file" >
                        </div>
       
      
                        <div class="col-lg-12" align="center">
                            <input type="hidden" name="id" value="{{$book->id}}">
                            {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
                            <a href="/books" class="btn btn-danger sbmt-b">Cancel</a>
                        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop

@section('dialogs')

@stop