<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Models\Attachment;
use App\Models\Post;
use App\Services\AttachmentService;

class AttachmentController extends Controller
{
    /**
     * AttachmentController
     */
    public function __construct(
        private readonly AttachmentService $attachmentService
    ) {
        $this->authorizeResource(Attachment::class, 'attachment');
    }

    /**
     * 파일첨부
     *
     * @param  \App\Http\Requests\StoreAttachmentRequest  $request
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function store(StoreAttachmentRequest $request, Post $post)
    {
        $this->attachmentService->store($request->validated(), $post);
    }

    /**
     * 첨부파일 삭제
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attachment $attachment)
    {
        $this->attachmentService->destroy($attachment);

        return back();
    }
}
