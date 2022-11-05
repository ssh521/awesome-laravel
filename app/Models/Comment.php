<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id

 * @property string $content
 * @property int $user_id
 * @property User $user
 * @property int $commentable_id
 * @property string $commentable_type
 * @property Post $commentable
 * @property int $parent_id
 * @property Comment $parent
 * @property \Illuminate\Database\Eloquent\Collection $replies
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 */
class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'content',
    ];

    /**
     * 작성자
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 다형성
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * 부모
     *
     * @return mixed
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id')
            ->withTrashed();
    }

    /**
     * 대댓글
     *
     * @return mixed
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->withTrashed();
    }
}
