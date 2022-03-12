<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class Guest extends Model
{
    use Notifiable,
        HasPushSubscriptions;

    protected $fillable = [
        'endpoint',
    ];

    public function pushSubscriptionBelongsToUser($subscription)
    {
        return (int)$subscription->guest_id === (int)$this->id;
    }
}
