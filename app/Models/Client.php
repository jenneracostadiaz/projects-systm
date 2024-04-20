<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'document_type', 'document_number', 'email', 'phone'];

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
