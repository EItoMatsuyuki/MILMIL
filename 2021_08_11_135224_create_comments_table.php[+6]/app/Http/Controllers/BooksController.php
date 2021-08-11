<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Auth;

class BooksController extends Controller
{
//コンストラクタ    
public function __construct()
    {
        $this->middleware('auth');
    }


//本ダッシュボード表示
public function index()
{
    $userid  = Auth::user()->id;
    $books = Book::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    return view('books', [
        'books' => $books,
        'userid'=>$userid
    ]);
}
    //更新画面edit
public function edit($book_id)
{
    $books=Book::where('user_id',Auth::user()->id)->find($book_id);   
    //{books}id 値を取得 => Book $books id 値の1レコード取得
    return view('booksedit', ['book' => $books]);
}
    
    
    
    //store
    public function store(Request $request){
                  //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|max:255',
            'item_number' => 'required|max:10',
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        

        //以下に登録処理を記述（Eloquentモデル）
        // Eloquentモデル
        $books = new Book;
        $books->user_id     = Auth::user()->id;
        $books->item_name   = $request->item_name;
        $books->item_number = $request->item_number;
        $books->save(); 
        return redirect('/');
            }
    
    
    
    //update更新処理
    public function update(Request $request){
             //バリデーション
            $validator = Validator::make($request->all(), [
                'id'            => 'required',
                'item_name'     => 'required|max:255',
                'item_number'   => 'required|max:10',
            ]);
        
            //バリデーション:エラー 
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
            }
            //以下に登録処理を記述（Eloquentモデル）
            // Eloquentモデル
            $books =Book::where('user_id',Auth::user()->id)->find($request->id);
            $books->item_name   = $request->item_name;
            $books->item_number = $request->item_number;
            $books->save(); 
            return redirect('/');
            }
            
    //質問詳細 
    public function question($book_id)
    {
        $books=Book::where('user_id',Auth::user()->id)->find($book_id);   
        //{books}id 値を取得 => Book $books id 値の1レコード取得
        return view('question', ['book' => $books]);
       
    }
    
            
    //削除
    public function destroy(Book $book)
    {
        $book->delete();       //追加
        return redirect('/');  //追加
    }
    
    
    //コメント
    public function comments($comment_id)
    {
                  //バリデーション
        $validator = Validator::make($request->all(), [
            'comments' => 'required|max:255',
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/question')
                ->withInput()
                ->withErrors($validator);
        }
        

        //以下に登録処理を記述（Eloquentモデル）
        // Eloquentモデル
        $comments = new Comment;
        $comments->user_id     = Auth::user()->id;
        $comments->comments   = $request->comments;
        $comments->save(); 
        return redirect('/question');
    }
}
