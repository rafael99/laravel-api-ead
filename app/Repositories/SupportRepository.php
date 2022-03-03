<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Models\Support;
use App\Models\User;

class SupportRepository {
  protected $entity;

  public function __construct(Support $model)
  {
    $this->entity = $model;    
  }

  public function getSupports(array $filters = [])
  {
    return $this->getUserAuth()
                ->supports()
                ->where(function($query) use($filters) {
                  if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                  }

                  if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                  }

                  if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                  }
                })
                ->get();
  }

  public function createNewSupport(array $data): Support
  {
    $support = $this->getUserAuth()
                    ->supports()
                    ->create($data);

    return $support;
  }

  public function createReplyToSupportId(string $supportId, array $data): ReplySupport
  {
    $user = $this->getUserAuth();

    return $this->getSupport($supportId)
                ->replies()
                ->create([
                  'description' => $data['description'],
                  'user_id' => $user->id
                ]);
  }

  private function getSupport(string $id): Support
  {
    return $this->entity->findOrFail($id);
  }

  private function getUserAuth(): User
  {
    // return auth()->user();
    return User::first();
  }

}