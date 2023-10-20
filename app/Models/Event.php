<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    /**
     * Get the event participants associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EventParticipants(): HasMany
    {
        return $this->hasMany(EventParticipant::class);
    }

    /**
     * Get the comments for the event.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the event likes for the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventLikes(): HasMany
    {
        return $this->hasMany(EventLike::class);
    }

    /**
     * Get the event status associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventStatus(): HasOne
    {
        return $this->hasOne(EventStatus::class, 'id', 'lu_event_status_id');
    }

    /**
     * Get the event type associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventType(): HasOne
    {
        return $this->hasOne(EventStatus::class, 'id', 'lu_event_types_id');
    }

    /**
     * Get the city associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class);
    }

    /**
     * Get the event attachments for the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventAttachments(): HasMany
    {
        return $this->hasMany(EventAttachment::class);
    }
}
