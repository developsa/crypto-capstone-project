@extends('layouts.home')
@section('content')
    <div class="card-body">
        <h4 class="card-title">Comments List</h4>
        <p><a href="{{ route('updateComment') }}">New Comment</a></p>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th>Comment</th>
                    <th>Comment of Users</th>
                    <th>Operations</th>


            </thead>
            <tbody>
                @foreach ($allComments as $comment)
                    <tr>
                        <td scope="row" style="background-color: grey">{{ $comment->id }}</td>
                        <td>{{ $comment->content }}</td>
                        @foreach ($userList as $user)
                            @if ($user->id == $comment->user_id)
                                <td>{{ $user->name }}</td>
                            @endif
                        @endforeach


                        <td><a href="{{ route('updateComment', ['id' => $comment->id]) }}">Edit<i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <button onclick="confirmDelete('{{ $comment->id }}')">Delete
                                <a href="{{ route('deleteComment', ['id' => $comment->id]) }}"> </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id) {

            const onay = confirm(" Are you sure delete?");
            if (onay) {

                window.location.href = '{{ route('deleteComment') }}' + '/' + id;

            }
        }
    </script>
@endSection
