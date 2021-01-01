<?php


namespace App\Services;


use App\Models\Comment;
use App\Repositories\GetsCommentsRepository;
use App\Repositories\StoreDeleteStoreDeleteCommentsRepository;
use App\Services\Interfaces\CommentsServiceInterface;
use App\Traits\ResponseDataTrait;

class CommentsService implements CommentsServiceInterface
{
    use ResponseDataTrait;
    private $commentRepository;
    private $getcommentsRepository;

    public function __construct(StoreDeleteStoreDeleteCommentsRepository $commentRepository,
    GetsCommentsRepository $getcommentsRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->getcommentsRepository = $getcommentsRepository;
    }

    public function getCommentOfTasting($tasting)
    {
        $res = $this->getcommentsRepository->getCommentsOfTasting($tasting);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function getMyComments()
    {
        $res = $this->getcommentsRepository->getMyComments();
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Not found', 404);
    }

    public function storeComment($tasting, $data)
    {
        $res = $this->commentRepository->storeComment($tasting, $data);
        return $res ? $this->responseWithData($res, 200)
            : $this->responseWithMessage('Comment has been stored', 400);
    }

    public function deleteComment($comment)
    {
        return $comment->delete() ? $this->responseWithMessage('Comment has been removed', 200)
            : $this->responseWithMessage('Not found', 404);
    }
}
