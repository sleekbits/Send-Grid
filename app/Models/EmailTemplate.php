<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = ['name', 'category', 'subject', 'html_body', 'json_schema', 'is_active', 'created_by'];

    protected function casts(): array { return ['is_active' => 'boolean']; }
}
