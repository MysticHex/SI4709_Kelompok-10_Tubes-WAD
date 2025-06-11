<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TAKSubmission extends Model
{
    use HasFactory;
    protected $table = 'tak_submissions';
    protected $fillable = [
        'user_id', 'activity_name', 'category', 'level',
        'activity_date', 'file_path', 'approval_status_id', 'point'
    ];

    public function user(array $attributes = ['user_id'])
    {
        return $this->belongsTo(User::class);
    }

    public function status(array $attributes = ['approval_status_id'])
    {
        return $this->belongsTo(ApprovalStatus::class, 'approval_status_id');
    }
}
