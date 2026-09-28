<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['user_id', 'template', 'name', 'headline', 'bio', 'skills', 'projects', 'contact'];
    protected $casts = ['projects' => 'array'];

    public function user() { return $this->belongsTo(User::class); }
}
