<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param Request $request
   * @return array
   */
  public function toArray($request): array
  {
    return [
      'created_at_diff' => $this->created_at->diffForHumans(),
      'created_at' => $this->created_at,
      'id' => $this->id,
      'type' => $this->event_type->name,
      'user' => $this->user->name,
      'details' => $this->details,
      'total_amount' => $this->details->sum('amount'),
    ];
  }
}
