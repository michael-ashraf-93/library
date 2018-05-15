<?php

namespace App\Http\Controllers;

// namespace App\Http\Controllers\userController;

use App\Book;
use App\Borrow;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateBookRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\UpdateclientsRequest;
//use Flash;
use App\User;

use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Activity;


class AdminController extends Controller
{


    private $UserController;

    public function __construct(UserController $Usercontroller)
    {
        $this->UserController = $Usercontroller;

        $this->middleware('auth');

    }


////////////////////  Admin Users Controllers   ////////////////////

////////////////////    Show and Manage All Users     ////////////////////
    public function index()
    {
        $users = User::all();
        $books = Book::all();
        $bowrrows = Borrow::all();

//        return view('admin.dashboard', compact('users'));
        return view('admin.dashboard', compact('users', 'books', 'bowrrows'));
    }

////////////////////    Show All User's Data     ////////////////////
    public function show($id)
    {

        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User Not Found');

            return redirect(route('/admin'));
        }

        return view('admin.show', compact('user'));


    }

////////////////////    Edit User     ////////////////////
    public function edit($id)
    {

        $user = User::find($id);

        if (empty($user)) {
            Flash::error('Clients not found');

            return redirect('/admin');
        }

        return view('admin.edit')->with('user', $user);

    }

////////////////////    Update User     ////////////////////
    public function update($id, UpdateUserRequest $request)
    {
        $user = User::find($id);
        $password = $request->password;
        if (isset($password)) {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'confirmed|min:6',
                'role' => 'required'

            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt(request('password'))
            ]);
        } else {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required'

            ]);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);
        }
        Flash::success('User Updated successfully.');

        return redirect('/admin');
    }

////////////////////    Delete User And Deactivate All Posts and Comments     ////////////////////

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {

            Flash::error('User not found');

            return redirect('/admin');

        } else {

            $borrow = Borrow::all()->where('user_id', $id);

            if (count($borrow)) {
                Flash::error('User Has Unreturned Books');
                return redirect('/admin/borrows');
            } else {
                $user->delete($id);
                Flash::success('User Deleted Successfully.');
                return redirect('/admin');

            }
        }

    }

////////////////////    Add User     ////////////////////
    public function getUserField()
    {
        return view('admin.addUser');
    }

    public function createUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            Flash::error('Email is already been taken');
            return redirect('/admin');
        }
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required'

        ]);
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(request('password')),
            'role' => $request->role
        ]);

        Flash::success('User added successfully.');

        return redirect('/admin');
    }


////////////////////  Admin Posts Controllers   ////////////////////

////////////////////    Show And Manage All  Post     ////////////////////
    public function books()
    {
        $book = Book::latest()->get();
        return view('.admin.books', compact('book', 'userr'));

    }

////////////////////    Show Post And it's Comments    ////////////////////
//    public function showBook(Post $book)
//    {
//
//        return view('books.show', compact('book'));
//
//    }
///////////////////////////// Add New Book ///////////////////////////////////
    public function getBookField()
    {
        return view('admin.addBook');
    }

    public function createBook(Request $request)
    {
        $book = Book::where('serial', $request->serial)->first();
        if (isset($book)) {
            Flash::error('Book is already been exist');
            return redirect('/admin/books');
        }

        Book::create([
            'serial' => $request->serial,
            'book_name' => $request->book_name,
            'category' => $request->category,
            'author_name' => $request->author_name,
            'publication_date' => $request->publication_date,
            'status' => $request->status
        ]);

        Flash::success('User added successfully.');

        return redirect('/admin/books');
    }

////////////////////    Edit Post     ////////////////////
    public function editBook($id)
    {

        $book = Book::find($id);

        if (empty($book)) {
            Flash::error('Book Not Found');

            return redirect('/admin/book');
        }

        return view('admin.editBook', compact('book'));

    }

////////////////////    Update Post     ////////////////////
    public function updateBook($id, UpdateBookRequest $request)
    {
        $book = Book::find($id);
        $book->update([
            'serial' => $request->serial,
            'book_name' => $request->book_name,
            'category' => $request->category,
            'author_name' => $request->author_name,
            'publication_date' => $request->publication_date,
            'status' => $request->status
        ]);

        Flash::success('Book Updated successfully.');

        return redirect('/admin/books');
    }

////////////////////    Activate/Approve Post     ////////////////////
    public function availableBook($id)
    {

        $book = Book::find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect('admin/books');
        }
        $borrow = Borrow::where('book_id',$id);
        if(isset($borrow)) {
            $borrow->delete();
            Book::where('id', $id)->update(['status' => 'available']);
            Flash::success('Book Is Available.');
        }
        else
        {
            Flash::success('Book Is Not Borrowed.');
        }

        return redirect('admin/books');

    }

////////////////////    Deactivate/Disapprove Post     ////////////////////
    public function unavailableBook($id)
    {

        $book = Book::find($id);

        if (empty($book)) {
            Flash::error('Book Not Found');

            return redirect('admin/books');
        }

        Flash::success('Book Is Unavailable.');
        Book::where('id', $id)->update(['status' => 'unavailable']);

        return redirect('admin/books');

    }

////////////////////    Delete Book     ////////////////////
    public function destroyBook($id)
    {

        $book = Book::find($id);

        if (empty($book)) {
            Flash::error('Post Not Found');

            return redirect('/admin/books');
        } else {

            $book->delete($id);

            Flash::success('Book Deleted Successfully.');

            return redirect('/admin/books');
        }

    }

////////////////////  Admin Borrows Controllers   ////////////////////

////////////////////    Show All Borrows     ////////////////////
    public function borrows()
    {
        $borrows = Borrow::all();
        return view('.admin.borrows', compact('borrows', 'userr'));

    }

////////////////////    Edit Borrow     ////////////////////
    public function editBorrow($id)
    {

        $borrow = Borrow::find($id);

        if (empty($borrow)) {
            Flash::error('Borrow Not Found');

            return redirect('/admin/borrows');
        }

        return view('admin.editBorrow', compact('borrow'));

    }

////////////////////    Update Borrow     ////////////////////
    public function updateBorrow($id, UpdateBorrowRequest $request)
    {
        $borrow = Borrow::find($id);
        $borrow->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'book_name' => $request->book_name,
            'borrow' => $request->borrow,
            'status' => $request->status
        ]);

        Flash::success('Borrow Updated successfully.');

        return redirect('/admin/bowrrows');
    }

////////////////////    Delete Borrow     ////////////////////
    public function destroyBorrow($id)
    {
        $borrow = Borrow::find($id);

        if (empty($borrow)) {
            Flash::error('Borrow Not Found');

            return redirect('/admin/borrows');
        } else {
            $book = Book::where('id', $borrow->book_id);
            $book->update(['status' => 'available']);
            $borrow->delete($id);

            Flash::success('Book Returned');

            return redirect('/admin/borrows');

        }


    }

}