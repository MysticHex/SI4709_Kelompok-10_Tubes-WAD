<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalStatus extends Model
{
    use HasFactory;
        protected $fillable = ['status', 'description'];

    public function submissions()
    {
        return $this->hasMany(TAKSubmission::class);
    }
}
