<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matter extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'is_display',
        'occupation_id',
        'occupation_detail_id',
        'title',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'image_6',
        'image_7',
        'image_8',
        'image_9',
        'image_10',
        'content_1',
        'content_2',
        'content_3',
        'content_4',
        'content_5',
        'content_6',
        'content_7',
        'content_8',
        'content_9',
        'content_10',
        'sub_title_1',
        'sub_title_2',
        'sub_title_3',
        'sub_title_4',
        'sub_title_5',
        'sub_title_6',
        'sub_title_7',
        'sub_title_8',
        'sub_title_9',
        'sub_title_10',
        'price',
        'discount',
        'publish_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
