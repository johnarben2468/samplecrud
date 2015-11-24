
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

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading" align='center'>
                Books
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Author</th>
                <th>Date</th>
                <th>Image</th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody>

    @if(Session::get('noresults'))
            <tr>
                <td colspan='6'>
                    <center>{{ Session::get('noresults') }}</center>
                </td>
            </tr>
            {{ Session::forget('noresults') }}
    @endif

            @foreach($books as $book)
                <tr>
                    <td>{{ $book->name  }}</td>
                    <td>{{ $book->author  }}</td>
                    <td>{{ $book->date  }}</td>
                    <td><a href="{{asset('uploads/book/'.$book->file)}}" data-lightbox="{{$book->name}}" title="{{$book->name}}">
                        <img class="img-thumbnail" src="{{asset('uploads/book/'.$book->file)}}" style="width: 80px; height: 80px;" /></td>
                   
                    <td>
                        <a href="/books/edit/{{$book->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                    
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#delete_' . $book->id }}"  data-toggle="tooltip" data-placement="top"  title="Delete Book"><i class="fa fa-times"></i></button>

                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>


        <center>{{ $books->links(); }}</center>
    </div>

   
    </div>
    </div>
    </div>
</div>
</div>
    
    


    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'method' => 'POST', 'files' => true)) }}

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Add Book
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="left">
        
      

        <div class="form-group @if ($errors->has('name')) has-error @endif">
            <label>Book Name</label>
                {{ Form::text('name',Session::get('name'), array('class' => 'form-control  ', 'placeholder' => 'Name','maxlength'=>'255')) }}
      
            @if ($errors->has('name')) 
                <p class="help-block">{{ $errors->first('name') }}</p>  
            @endif

        </div>

        <div class="form-group @if ($errors->has('author')) has-error @endif">
            <label>Author</label>
                {{ Form::text('author',Session::get('author'), array('class' => 'form-control  ', 'placeholder' => 'Author','maxlength'=>'255')) }}
       
            @if ($errors->has('author')) 
                <p class="help-block">{{ $errors->first('author') }}</p>  
            @endif

        </div>
        <div class="form-group @if ($errors->has('date')) has-error @endif">
            <label>Date Published</label>
                <input name="date" type="date" class="form-control">
       
            @if ($errors->has('date')) 
                <p class="help-block">{{ $errors->first('date') }}</p>  
            @endif

        </div>
        <div class="form-group <?php if($errors->first('file'))
              echo 'row has-error has-feedback'
              ?>" >
              <label>Thumbnail File</label>
                <input type="file" class="form-control" id="file" name="file" >
              
        </div>
       
        <div class="col-lg-12" align="center">
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Add">
        </div>
        {{ Form::close(); }}
   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('dialogs')
@foreach($books as $book)
    <?php 
        $modalName = "delete";
        $message = "Are you sure you want to delete book {$book->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $book->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Delete Book</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/books/delete/{{$book->id}}" class="btn btn-warning" id="confirm">Delete Book </a>
                </div>
            </div>
        </div>
    </div> 

   

@endforeach
@stop