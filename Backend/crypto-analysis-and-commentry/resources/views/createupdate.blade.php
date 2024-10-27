@extends('layouts.home')
@section('content')

    <!-- Create Comment-->
    @if ($comment == null)
        <div class="card-body ">
            <h5 class="card-title">Create Comment</h5>
            <form enctype="multipart/form-data" class="row g-3" method="post"
                action="{{ route('createComment', ['id' => @$comment->id]) }}">
                @csrf
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" name="content" rows="5" cols="50">{{ @$comment->content }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Coin Name</label>

                    <select name="gecko_coin_id">
                        <option value=""></option>
                        @foreach ($coinList as $coin)
                            <option value="{{ @$coin->id }}" @if (@$coin->id == @$comment->coin) selected @endif>
                                {{ $coin->gecko_coin_id }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-12">
                    <label class="form-label">User Name</label>

                    <select name="user_id">
                        <option value=""></option>
                        @foreach ($userList as $user)
                            <option value="{{ @$user->id }}" @if (@$user->id == @$comment->user_id) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>

                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create Comment</button>
                </div>

            </form>

        </div>
    @endif

    <!-- Update Comment-->
    @if ($comment)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Comment </h5>


                <form enctype="multipart/form-data" class="row g-3" method="post"
                    action="{{ route('createComment', ['id' => @$comment->id]) }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label">Comment</label>
                        <textarea class="form-control" name="content" rows="5" cols="50">{{ @$comment->content }}</textarea>

                    </div>
                    <div class="col-12">
                        <label class="form-label">Coin Name</label>
                        <select name="gecko_coin_id">
                            <option value=""></option>
                            @foreach ($coinList as $coin)
                                <option value="{{ @$coin->id }}" @if ($coin->id == @$comment->gecko_coin_id) selected @endif>
                                    {{ $coin->gecko_coin_name }} </option>
                            @endforeach

                        </select>



                    </div>
                    <div class="col-12">
                        <label class="form-label">User Name</label>

                        <select name="user_id">
                            <option value=""></option>
                            @foreach ($userList as $user)
                                <option value="{{ @$user->id }}" @if (@$user->id == @$comment->user_id) selected @endif>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        </form>

        </div>
    @endif



@endSection
