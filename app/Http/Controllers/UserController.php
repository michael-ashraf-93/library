<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBookRequest;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\User;
use App\Book;
use App\Borrow;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()

    {

        $this->middleware('auth')->except('books');

    }

    protected $fieldSearchable = [
        'name',
        'email',
        'role',
        'created_at',
        'updated_at'
    ];

////////////////////    Show User's Profile     ////////////////////
    public function profile($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User Not Found');

            return redirect('/');
        }

        return view('user.show', compact('user'));

    }

////////////////////    Edit User     ////////////////////
    public function edit($id)
    {
        if (auth()->user()->id == $id) {
            $user = User::find($id);

            if (empty($user)) {
                Flash::error('User not found');

                return redirect('/');
            }

            return view('user.edit')->with('user', $user);

        } else
            return redirect('/');
    }

////////////////////    Update User     ////////////////////
    public function update($id, UpdateUserRequest $request)
    {
        if (auth()->user()->id == $id) {
            $user = User::find($id);
            $password = $request->password;
            if (isset($password)) {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'confirmed|min:6',

                ]);

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt(request('password'))
                ]);
            } else {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email',

                ]);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            Flash::success('User Updated successfully.');

            return redirect()->back();
        } else {
            return redirect('/');
        }
    }


////////////////////    Delete User And Deactivate All Posts and Comments     ////////////////////
    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            $user = User::find($id);

            if (empty($user)) {

                Flash::error('User not found');

                return redirect()->back();

            } else {

                $borrow = Borrow::all()->where('user_id', $id);

                if (count($borrow)) {
                    Flash::error('You Have Unreturned Books');
                    return redirect('/user/borrows');
                } else {
                    $user->delete($id);
                    Flash::success('User Deleted Successfully.');
                    return redirect('/');

                }
            }
        } else

            return redirect('/');

    }


////////////////////  User Posts Controllers   ////////////////////

////////////////////    Show And Manage All Books     ////////////////////

    public function books()
    {
        $book = Book::latest()->get();
        return view('user.books', compact('book'));
    }

////////////////////    Show All Borrows     ////////////////////

    public function borrows($uid)
    {
        if (auth()->user()->id == $uid) {
            $borrows = Borrow::where(['user_id' => $uid])->latest()->get();
            return view('user.borrows', compact('borrows'));
        } else
            return redirect('/');
    }

    public function userBorrows()
    {
        if (auth()->user()->id) {
            $id = auth()->user()->id;
            $borrows = Borrow::where(['user_id' => $id])->latest()->get();
            return view('user.borrows', compact('borrows'));
        } else
            return redirect('/');
    }


////////////////////    Borrows Book     ////////////////////

    public function borrowBook($uid, $bid)
    {
        if (auth()->user()->id == $uid) {
            $borrow = Borrow::where('book_id',$bid)->get();
            $book = Book::where('id',$bid)->get();


            if (count($borrow)) {
                Flash::error('Book Is Already Borrowed');

                return redirect()->back();
            } else {
                foreach ($book as $book) {
                    if ($book->status == 'available') {
                        Borrow::create([
                            'user_id' => $uid,
                            'book_id' => $bid,
                            'book_name' => $book->book_name,
                            'borrow_at' => Carbon::now(),
                            'expires_at' => Carbon::now()->addWeek(1)
                        ]);
                        Flash::success('Book Is Borrowed');
                        Book::where('id', $bid)->update(['status' => 'unavailable']);
                    } else {
                        Flash::error('Book Is Not Available');

                    }
                }
                return redirect()->back();
            }
        } else
            return redirect()->back();
    }

////////////////////    Extend One Week     ////////////////////

    public function addTime($uid, $bid)
    {
        if (auth()->user()->id == $uid) {
            $borrow = Borrow::find($bid);

            if (empty($borrow)) {
                Flash::error('Book Not Found');

                return redirect()->back();
            } else
                $borrow->update([
                    'expires_at' => Carbon::now()->addWeek(1)
                ]);
            Flash::success('One Week Is Added');
            Book::where('id', $bid)->update(['status' => 'unavailable']);

            return redirect()->back();
        } else
            return redirect()->back();
    }

////////////////////    Return Book     ////////////////////

    public function returnBook($uid, $bid)
    {
        if (auth()->user()->id == $uid) {
            $borrow = Borrow::find($bid);
            if (empty($borrow)) {
                Flash::error('Book Not Found');

                return redirect()->back();
            } else
                Book::where('id', $borrow->book_id)->update(['status' => 'available']);
            $borrow->delete();
            Flash::success('Book Returned Successfully');

            return redirect()->back();
        } else
            return redirect()->back();
    }

}