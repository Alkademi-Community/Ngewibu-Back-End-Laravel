<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class EventService
{
    /**
     * Get a new query builder instance for the events.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return Event::query();
    }

    /**
     * Get all events with their relationships.
     *
     * @param int $paginate The number of items per page.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllEvents(int $paginate = 4): LengthAwarePaginator
    {
        $withRelationships = [
            'author:id,username', 
            'author.userProfile:id,user_id,full_name', 
            'author.userProfileAttachment', 
            'eventAttachments',
            'eventStatus',
            'eventType',
        ];

        return $this->query()
                    ->withoutTrashed()
                    ->with($withRelationships)
                    ->latest()
                    ->paginate($paginate);
    }
}