<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\AddBook;
use Illuminate\Support\Facades\Storage;

class AddBookController extends Controller
{


    
    public function store(Request $request){

    $books = new AddBook();
    $books->title = $request->input('title');
    $books->author = $request->input('author');
    $books->year = $request->input('year');
    $books->selling = $request->input('selling');
    $books->description = $request->input('description');

    $bookPath = $request->file('book')->store('public/books');
    $imagePath = $request->file('image')->store('public/images');

    $books->image = 'i'.ltrim($imagePath, 'public/');

    $books->book = 'b'.ltrim($bookPath, 'public/');

    $books->save();
    return response()->json([], 200);
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }
        return response()->json(AddBook::all());
    }

    public function show($id)
    {
        return response()->json(AddBook::find($id));

    }
    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }
        else{
            $books = AddBook::findOrFail($id);
            $books->delete();
            $response['message'] = 'Successfully deleted';
        }
       

    }
    public function update(Request $request, $id)
    {

        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }
        else{
            $books = AddBook::find($id);
            $books->title = $request->title;
            $books->author = $request->author;
            $books->year = $request->year;
            $books->selling = $request->selling;
            $books->description = $request->description;
            $books->save();
        }


        // $response['message'] = 'Updated';
    }
}
