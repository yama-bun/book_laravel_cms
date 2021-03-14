<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Auth;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //一覧
    public function index()
    {
        $books = Book::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
        return view('books', [
            'books' => $books
        ]);
    }

    //更新画面
    public function edit($book_id)
    {
        $books = Book::where('user_id', Auth::user()->id)->find($book_id);
        return view('edit', ['book' => $books]);
    }

    //更新
    public function update(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required', 'min:3', 'max:255',
            'item_number' => 'required', 'min:1', 'max:3',
            'item_amount' => 'required', 'max:6',
            'published' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $books = Book::where('user_id', Auth::user()->id)->find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_number;
        $books->published = $request->published;
        $books->save();
        return redirect('/');
    }

    //登録
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required', 'min:3', 'max:255',
            'item_number' => 'required', 'min:1', 'max:3',
            'item_amount' => 'required', 'max:6',
            'published' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $file = $request->file('item_img');
        if(!empty($file)){
            $filename = $file->getClientOriginalName(); //ファイル名取得
            $move = $file->move('/public/upload/',$filename); //ファイルを移動
        } else {
            $filename = '';
        }
        //Eloquent
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->item_img = $filename;
        dd($books->item_img);
        $books->published = $request->published;
        $books->save();
        return redirect('/')->with('message', '登録が完了しました。');
    }

    //削除
    public function delete(Book $book)
    {
        $book->delete();
        return redirect('/');
    }


}
