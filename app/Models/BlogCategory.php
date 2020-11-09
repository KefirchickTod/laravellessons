<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package App\Models
 *
 * @property BlogCategory $category
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @property string $description
 */
class BlogCategory extends Model
{
    use SoftDeletes;
    const ROOT = 1;
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * @return BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Accessor
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Root' : '???');
        return $title;
    }

    private function isRoot()
    {
        return $this->id === self::ROOT || $this->id === 0;
    }

}
