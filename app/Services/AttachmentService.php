<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\Post;

class AttachmentService
{
    /**
     * 파일첨부
     *
     * @param  array  $data
     * @return void
     */
    public function store(array $data, Post $post): void
    {
        foreach ($data['attachments'] as $attachment) {
            $attachment->storePublicly('attachments', 'public');

            $post->attachments()->create([
                'original_name' => $attachment->getClientOriginalName(),
                'name' => $attachment->hashName('attachments'),
            ]);
        }
    }

    /**
     * 첨부파일 삭제
     *
     * @param  Attachment  $attachment
     * @return void
     */
    public function destroy(Attachment $attachment): void
    {
        $attachment->delete();
    }
}
