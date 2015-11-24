<?php
 

 
class BookController extends BaseController {
 
 
  public function add()
  {
    $rules = array(
      'name'    => 'required|unique:books,name', 
      'author'    => 'required', 
      'date'    => 'required', 
      'file' => 'mimes:jpeg,bmp,png',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else 
    {
   
       
      $destinationPath = '';
          $filename        = '';

      if (Input::hasFile('file')) {
          $file            = Input::file('file');
          $destinationPath = public_path().'/uploads/book/';
          $filename        = str_random(6) . '_' . $file->getClientOriginalName();
          $uploadSuccess   = $file->move($destinationPath, $filename);
      }

        $book_save= new Book;
        $book_save->name=strip_tags(Input::get('name'));
        $book_save->author=strip_tags(Input::get('author'));
        $book_save->date=Input::get('date');
        $book_save->file=$filename;
        $book_save->save();
    
    
      Session::put('msgsuccess', 'Successfully added book.');
      return Redirect::back();

    }
  }
   
  public function edit($id)
  {
    $exist = Book::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withInput(); 
    }
      

     $rules = array(
      'name'    => 'required', 
      'author'    => 'required', 
      'date'    => 'required', 
      'file' => 'mimes:jpeg,bmp,png',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else 
    {
          $book_save= Book::find($id);
          $destinationPath = '';
          $filename        = $book_save->file;

      if (Input::hasFile('file')) {
          $file            = Input::file('file');
          $destinationPath = public_path().'/uploads/book/';
          $filename        = str_random(6) . '_' . $file->getClientOriginalName();
          $uploadSuccess   = $file->move($destinationPath, $filename);
      }
        
        $book_save->name=strip_tags(Input::get('name'));
        $book_save->author=strip_tags(Input::get('author'));
        $book_save->date=Input::get('date');
        $book_save->file=$filename;
        $book_save->save();
    
      Session::put('msgsuccess', 'Successfully edited book.');
      return Redirect::to("/books");
    }
  }

public function delete($id)
  {
    $exist = Book::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Failed to delete book.');
      return Redirect::back()
        ->withInput(); 
    }
      $book = Book::find($id);

      unlink(public_path()."/uploads/book/".$book->file);
      Book::where('id',$id)->delete();

   
      Session::put('msgsuccess', 'Successfully deleted book.');
      return Redirect::back();
    
  }
 
  
}