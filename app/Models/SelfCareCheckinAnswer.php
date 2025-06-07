<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SelfCareCheckinAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkin_id',
        'question_id',
        'answer',
    ];

    protected $casts = [
        'answer' => 'boolean',
    ];

    public function checkin()
    {
        return $this->belongsTo(SelfCareCheckin::class, 'checkin_id');
    }

    public function question()
    {
        return $this->belongsTo(SelfCareQuestion::class, 'question_id');
    }
}
