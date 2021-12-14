<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use ElasticquentTrait, HasFactory;
    protected $guarded = [];

    protected $mappingProperties = array(
        'title' => [
          'type' => 'text',
          "analyzer" => "standard",
        ],
        'description' => [
          'type' => 'text',
          "analyzer" => "standard",
        ],
        'manufacturer' => [
          'type' => 'text',
          "analyzer" => "standard",
        ],
    );

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
