<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Coin;

class CommentController extends Controller
{

    //GetAll
    public function getAllComment()
    {
        $allComments = Comment::get();
        $userList = User::with("comments")->get();
        return response()->json([
            "message" => "Comments and Users retrieved successfully",
            "comments" => $allComments,
            "users" => $userList
        ]);
    }

    public function getCoinUserList()
    {
        $userList = User::with("comments")->get();
        $coinList = Coin::get();
        return response()->json([
            "message" => "Coins and Users retrieved successfully",
            "coins" => $coinList,
            "users" => $userList
        ]);
    }

    public function getShowCoin($geckoCoinId)
    {
        $coin = Coin::where('gecko_coin_id', $geckoCoinId)->first();

        if (!$coin) {
            return response()->json([
                "message" => "Coin not found"
            ], 404);
        }

        return response()->json(['coins' => $coin], 200);
    }

    //GetId
    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(["message" => "Comment not found"], 404);
        }
        return response()->json(['comments' => $comment], 200);
    }


    //Create Operation

    public function createComment(Request $request, $id = false)
    {

        if ($id) {
            $comment = Comment::where("id", $id)->firstOrFail();
            $comment->fill($request->all());
            $comment->save();
        } else {
            $comment = new Comment;
            $comment->fill($request->all());
            $comment->save();
        }
        return response()->json([
            "message" => "Comment successfully",
        ]);
    }
    //Update Operation
    public function update(Request $request, $id)
    {
        //dd($id);
        try {
            $comment = Comment::find($id);
            // dd($comment->gecko_id);
            if (!$comment) {
                return response()->json(["message" => "Not found comment"], 404);
            }
            $comment->content = $request->content;
            $comment->gecko_coin_id = $request->gecko_coin_id;
            $comment->user_id = $request->user_id;
            $comment->save();
            return response()->json(["message", "Succesfly update comment"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Something bok really wrong"], 500);
        }
    }

    // //Delete Operation
    public function delete($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(["message" => "Comment not found"], 404);
        }

        $comment->delete();
        return response()->json(["message" => "Commen succesfly deleted"]);
    }
}
