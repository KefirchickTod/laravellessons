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
 * @property string       $title
 * @property string       $slug
 * @property int          $parent_id
 * @property string       $description
 */
class BlogCategory extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description'
    ];


}
