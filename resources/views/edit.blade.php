@extends('layouts.app')

@section('content')
    <div class="row container">
        <div class="col-md-12">
            @include('common.errors')
            <form action="{{ url('books/update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="item_name">本のタイトル</label>
                    <input type="text" name="item_name" class="form-control" value="{{ $book->item_name }}">
                </div>

                <div class="form-group">
                    <label for="item_number">冊数</label>
                    <input type="number" name="item_number" class="form-control" value="{{ $book->item_number }}">
                </div>

                <div class="form-group">
                    <label for="item_amount">金額</label>
                    <input type="number" name="item_amount" class="form-control" value="{{ $book->item_amount }}">
                </div>

                <div class="form-group">
                    <label for="published">公開日</label>
                    <input type="text" name="published" class="form-control" value="{{ $book->published }}">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('/') }}" class="btn btn-link pull-right">Back</a>
                </div>

                <input type="hidden" name="id" value="{{ $book->id }}">
            </form>
        </div>
    </div>
@endsection
