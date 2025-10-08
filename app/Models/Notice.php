<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    /**
     * Mass assignable attributes for notice management.
     */
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Get a truncated version of the content for previews.
     */
    public function getPreviewAttribute(): string
    {
        return \Illuminate\Support\Str::limit($this->content, 150);
    }

    /**
     * Check if the notice content needs a "read more" link.
     */
    public function needsReadMore(): bool
    {
        return strlen($this->content) > 150;
    }
}
