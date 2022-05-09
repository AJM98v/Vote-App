<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function votes(){
        return $this->belongsToMany(User::class,'votes');
    }

//    public function getStatusClasses()
//    {
//        return match ($this->status->name) {
//            "Considering" => "bg-purple text-white",
//            "In Progress" => "bg-yellow text-white",
//            "Implemented" => "bg-blue text-white",
//            "close" => "bg-red text-white",
//            default => "bg-gray-300 text-black",
//        };
//    }


    public function isVotedByUser(?User $user)
    {
        if (!$user){
                return false;
        }
        return Vote::where('user_id',$user->id)
            ->where('idea_id',$this->id)
            ->exists();
    }


}
