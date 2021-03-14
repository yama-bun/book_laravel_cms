@extends('layouts.app')

@section('content')
    <div class="cart-body">

        @include('common.errors')

        <form enctype="multipart/form-data" action="{{ url('books') }}" method="post" class="form-horizontal">
            @csrf

            <div class="form-group">
                <div class="col-sm-6">
                    <label for="item_name" class="control-label">
                        本のタイトル
                    </label>
                    <input type="text" name="item_name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <label for="item_number" class="control-label">
                        冊数
                    </label>
                    <input type="number" name="item_number" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <label for="item_amount" class="control-label">
                        金額
                    </label>
                    <input type="number" name="item_amount" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <label for="published" class="control-label">
                        公開日
                    </label>
                    <input type="date" name="published" class="form-control">
                </div>
            </div>


            <div class="col-sm-6">
                <label>画像</label>
                <input type="file" name="item_img">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (count($books) > 0)
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card-body">
        <div class="card-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>本一覧</th>
                    <thead>&nbsp;</thead>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td class="table-text">
                            <div>{{ $book->item_name }}</div>
                            <div><img src="/upload/.{{ $book->item_img }}" width="100"></div>
                        </td>
                        <td class="table-text">
                            <div>{{ $book->item_number }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $book->item_amount }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $book->published }}</div>
                        </td>

                        {{--  更新機能  --}}
                        <td>
                            <form action="{{ url('edit/'.$book->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    更新
                                </button>
                            </form>
                        </td>

                        {{--  削除機能  --}}
                        <td>
                            <form action="{{ url('book/'.$book->id) }}" method="post">
                                @csrf
                                @method('DELETE')
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
            <div class="col-md-4 offset-md-4">
                {{ $books->links() }}
            </div>
        </div>
    @endif
@endsection
