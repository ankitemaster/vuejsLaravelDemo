<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $guarded = [];

    public function users() {
        return $this->hasMany(UserProject::class, 'project_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function(Project $project)
        {
            $project->user_id =  auth()->user()->id;
        });
    }
}
