<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'content', 'image_path', 'image_url','category_id','user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId)
    {
        return in_array($tagId,$this->tags->pluck('id')->ToArray());
    }


    public function deleteImage()
    {
        Storage::disk('s3')->delete($this->image_path);
       //dd($this);
       //Storage::disk('s3')->delete('images/QwoPRuq8Pmijhf1n0Mod6SBcxs0nT5VlgJDJAXVi.jpeg');
   
    }
}
