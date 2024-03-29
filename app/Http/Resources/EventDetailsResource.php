<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailsResource extends JsonResource
{
  public function toArray($request): array
  {
    return [
      'amount' => $this->amount,
      'created_at' => $this->event->created_at,
      'created_at_diff' => $this->event->created_at->diffForHumans(),
      'type' => $this->event->event_type->name,
      'user' => $this->event->user->name,
      'utensil' => $this->utensil->name,
    ];
  }
}
