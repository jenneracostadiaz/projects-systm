<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'status', 'client_id', 'budget_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
