<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
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
        $this->authorizeResource(Attachment::class, 'attachment', [
            'except' => ['store'],
        ]);

        $this->middleware('can:create,App\Models\Attachment,post')
            ->only('store');
    }

    /**
     * 파일 생성
     *
     * @return void
     */
    public function store(StoreAttachmentRequest $request, Post $post)
    {
        $this->attachmentService->store($request->validated(), $post);
    }

    /**
     * 파일 삭제
     */
    public function destroy(Attachment $attachment): RedirectResponse
    {
        $this->attachmentService->destroy($attachment);

        return back();
    }
}
