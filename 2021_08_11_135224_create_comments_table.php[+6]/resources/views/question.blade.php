@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('books/update') }}" method="POST">

        <!-- published -->
        <div class="form-group">
           <label for="published">公開日時</label>
            <input type="datetime" id="created_at" name="created_at" class="form-control" value="{{$book->created_at}}"/>
        </div>
        <!--/ published -->
        
        <!-- item_name -->
        <div class="form-group">
           <label for="item_name">質問タイトル</label>
           <input type="text" id="item_name" name="item_name" class="form-control" value="{{$book->item_name}}">
        </div>
        <!--/ item_name -->
        
        <!-- item_number -->
        <div class="form-group">
           <label for="item_number">質問内容</label>
        <input type="text" id="item_number" name="item_number" class="form-control" value="{{$book->item_number}}">
        </div>
        <!--/ item_number -->
    
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
        
        <!-- コメント 投稿-->
        <form enctype="multipart/form-data" action="{{ url('question') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
        
                    <!-- コメント -->
                    <div class="form-group">
                        <div class="col-sm-6">
                            コメント
                            <input type="text" name="comments" class="form-control">
                        </div>
                    </div>
                    
                    <!-- コメント -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                コメント投稿
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        <!-- コメント -->

         
      
         
    </form>
    </div>
</div>
@endsection