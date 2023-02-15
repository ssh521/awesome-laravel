<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * CommentController
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * 댓글 쓰기
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request, Post $post): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $comment = $user->comments()->make($request->validated());

        $post->comments()->save($comment);

        return back();
    }

    /**
     * 댓글 수정
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCommentRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->validated());

        return back();
    }

    /**
     * 댓글 삭제
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return back();
    }
}
