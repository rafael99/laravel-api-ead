<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository
{
  use RepositoryTrait;

  protected $entity;

  public function __construct(Support $model)
  {
    $this->entity = $model;    
  }

  public function getSupports(array $filters = [])
  {
    return $this->entity
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

                  if (isset($filters['user_auth'])) {
                    $user = $this->getUserAuth();

                    $query->where('user_id', $user->id);
                  }
                })
                ->orderBy('updated_at')
                ->get();
  }

  public function getMySupports(array $filters = [])
  {
    $filters['user_auth'] = true;

    return $this->getSupports($filters);
  }

  public function createNewSupport(array $data): Support
  {
    $support = $this->getUserAuth()
                    ->supports()
                    ->create($data);

    return $support;
  }

  private function getSupport(string $id): Support
  {
    return $this->entity->findOrFail($id);
  }

}