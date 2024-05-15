<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
    //   'is_suspend' => $this->is_suspend,
      'is_otp' => $this->is_otp,
      // 'nip' => $this->nip,
      "employee" => $this->employee,
      "roles" => $this->roles,
    //   "employee" => $this->whenLoaded("employee", fn () => new EmployeeResource($this->employee)),
    //   "roles" => $this->whenLoaded("roles", fn () => RoleResource::collection($this->roles)),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
      // 'role' => $this->whenLoaded('role', fn () => new RoleResource($this->role->load(['privileges.menu.subMenus']))),
    ];
  }
}
