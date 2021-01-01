<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Tasting;
use App\Services\CommentsService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentsService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware(['auth:api']);
    }

    public function getCommentsOfTasting(Tasting $tasting)
    {
        return $this->commentService->getCommentOfTasting($tasting);
    }

    public function getMyComments()
    {
        return $this->commentService->getMyComments();
    }

    public function store(CommentRequest $request, Tasting $tasting)
    {
        return $this->commentService->storeComment($tasting, $request);
    }

    public function remove(Comment $comment)
    {
        return $this->commentService->deleteComment($comment);
    }
}
