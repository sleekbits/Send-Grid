<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = ['campaign_id','contact_id','provider','message_id','status','opened_at','clicked_at','bounced_at','failure_reason'];
    protected function casts(): array { return ['opened_at' => 'datetime', 'clicked_at' => 'datetime', 'bounced_at' => 'datetime']; }
}
