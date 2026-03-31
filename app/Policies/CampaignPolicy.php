<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;

class CampaignPolicy
{
    public function viewAny(User $user): bool { return $user->can('view reports') || $user->can('manage campaigns'); }
    public function create(User $user): bool { return $user->can('manage campaigns'); }
    public function update(User $user, Campaign $campaign): bool { return $user->can('manage campaigns'); }
    public function delete(User $user, Campaign $campaign): bool { return $user->hasRole(['Super Admin', 'Admin']); }
}
