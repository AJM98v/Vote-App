<?php

namespace App\Models;

use App\Exceptions\VoteDuplicateExption;
use App\Exceptions\VoteNotFOundExption;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * App\Models\Idea
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $slug
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $category_id
 * @property int $status_id
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $votes
 * @property-read int|null $votes_count
 * @method static \Database\Factories\IdeaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea query()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Idea extends Model
{
    use HasFactory, Sluggable ;

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

    public function votes()
    {
        return $this->belongsToMany(User::class, 'votes');
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
        if (!$user) {
            return false;
        }
        return Vote::where('user_id', $user->id)
            ->where('idea_id', $this->id)
            ->exists();
    }

    public function vote(User $user)
    {
        if ($this->isVotedByUser($user)){
            throw  new  VoteDuplicateExption();
        }
        Vote::create([
            'user_id' => $user->id,
            'idea_id' => $this->id
        ]);
    }

    public function removeVote(User $user)
    {
        $voteToDelete = Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->first();

        if ($voteToDelete){
            $voteToDelete->delete();
        }else{
            throw new VoteNotFOundExption;
        }


    }


}
