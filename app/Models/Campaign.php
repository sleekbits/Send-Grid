<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','subject','sender_name','sender_email','reply_to_email','type','status','scheduled_at','email_template_id',
        'segment_id','created_by','smtp_profile_id','total_recipients','sent_count','delivered_count','failed_count','open_count','click_count'
    ];

    protected function casts(): array { return ['scheduled_at' => 'datetime']; }

    public function emailLogs() { return $this->hasMany(EmailLog::class); }
}
