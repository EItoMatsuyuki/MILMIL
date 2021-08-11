<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">

        <td> {{ Auth::user() ->id }} </td>
        <td> {{ Auth::user() ->name }} さん </td>
        USERID:{{$userid}}

        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        <!-- 本登録フォーム -->
        <form enctype="multipart/form-data" action="{{ url('books') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- 本のタイトル -->
            <div class="form-group">
                <div class="col-sm-6">
                     質問タイトル
                    <input type="text" name="item_name" class="form-control">
                </div>
                <div class="col-sm-6">
                    質問内容
                    <input type="text" name="item_number" class="form-control">
                </div>
    

            </div>
            
            <!-- 本 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        投稿
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- Book: 既に登録されてる本のリスト -->

    <!-- 現在の本 -->
    @if (count($books) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>質問一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <!-- 質問タイトル -->
                                <td class="table-text">
                                    <div>タイトル：{{ $book->item_name }}</div>
                                    <div>内容：{{ $book->item_number }}</div>
                                    <div>公開日：{{ $book->created_at }}</div>
                                </td>
                                
                               <!-- 質問詳細遷移ボタン -->
                                <td>
                                    <form action="{{ url('question/'.$book->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            質問詳細
                                        </button>
                                    </form>
                                </td>
                               

                               <!-- 本:更新ボタン -->
                                <td>
                                    <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>
                                <!-- 本: 削除ボタン -->
                                <td>
                                    <form action="{{ url('book/'.$book->id) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class=" col -md -4 offset -md -4">
            {{ $books ->links()}}
            </div>
        </div>
    @endif

@endsection
