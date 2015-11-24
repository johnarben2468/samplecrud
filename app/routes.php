<?php
Route::get('/books', function()
{
  
		$books = DB::table('books')
	            ->paginate(10);
	
		return View::make('management')->with('books', $books);
	
});

Route::get('/books/edit/{id}', function($id)
{
   
		 $exist = Book::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit book.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$book = Book::find($id);
		return View::make('edit_books')->with('book', $book);
	


});
Route::post('/books/edit/{id}', array('uses' => 'BookController@edit'));

Route::post('/books', array('uses' => 'BookController@add', 'as'=>'books'));
Route::get('/books/delete/{id}', array('uses' => 'BookController@delete'));