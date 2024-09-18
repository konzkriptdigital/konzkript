<?php

namespace App\Livewire\Pages;

use App\Models\Account;
use App\Models\Company;
use App\Models\User;
use App\Traits\GenerateColors;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.editor')]
class Editor extends Component
{

    use GenerateColors;

    public Company $company;
    public $count;

    public function mount()
    {
        Debugbar::disable();
    }

    public function clicking(){
        $this->count++;
    }

    #[On('authorizeUserFromGhl')]
    public function authorizeUserFromGhl($data)
    {
        if ($data['ghl'] && $data['ghl']['user']) {
            $ghlData = $data['ghl'];
            $ghlData['user']['profile_color'] = $ghlUser['profileColor'] ?? null;

            // Handle the main user record
            $user = $this->updateOrCreateUser($ghlData['user'], true);

            // Update or create user status
            $user->status()->updateOrCreate(
                [],
                [
                    'is_online' => true,
                    'last_seen_at' => now()
                ]
            );

            // Process users in chunks to handle large datasets
            $chunkSize = 50; // Define a reasonable chunk size (e.g., 50)

            collect($ghlData['users'])->chunk($chunkSize)->each(function ($userChunk) {
                $this->processUserChunk($userChunk);
            });

            if(!Auth::check()) {
                Auth::login($user, true);
                $this->dispatch('reAuthenticateBroadcast');
            }

            $this->dispatch('getUserId', app: [
                "userId" => $user->only(['id'])
            ]);
        }
    }

    private function updateOrCreateUser($ghlUser, $isCurrentUser = false)
    {
        $password = Hash::make(Str::password(symbols: false, length: 8, numbers: false));

        // Find by ghl_id or email first
        $existingUser = $this->company->users()
            ->where('ghl_id', $ghlUser['id'])
            ->orWhere('email', $ghlUser['email'])
            ->first();

        $userData = [
            'name' => $ghlUser['name'],
            'first_name' => $ghlUser['firstName'],
            'last_name' => $ghlUser['lastName'],
            'email_verified_at' => now(),
            'password' => $password,
            'data' => $ghlUser,
            'user_type' => 'ghl',
            'role' => 'member',
            'avatar' => $ghlUser['avatar'] ?? null,
        ];

        if($isCurrentUser) {
            $userData['profile_color'] = $ghlUser['profileColor'];
        }

        if ($existingUser) {
            // If email matches but ghl_id does not, update the ghl_id to avoid conflict
            /* if ($existingUser->email === $ghlUser['email'] && $existingUser->ghl_id !== $ghlUser['id']) {
                $existingUser->ghl_id = $ghlUser['id'];
            } */

            $userData['role'] = $existingUser->role;

            $existingUser->update($userData);
            $user = $existingUser;
        } else {
            $userData['ghl_id'] = $ghlUser['id'];
            $userData['email'] = $ghlUser['email'];
            $userData['profile_color'] = $this->generateColor();

            // $userData['profile_color'] = $ghlUser['profile_color'];
            $user = $this->company->users()->create($userData);
        }

        // Attach the user to the account_user pivot table
        if (isset($ghlUser['roles']['location_ids']) && is_array($ghlUser['roles']['location_ids'])) {
            foreach ($ghlUser['roles']['location_ids'] as $location_id) {
                $account = Account::where('ghl_id', $location_id)->first();
                if ($account) {
                    $account->users()->syncWithoutDetaching([$user->id]); // Use syncWithoutDetaching to avoid duplicate entries
                }
            }
        }

        return $user;
    }

    private function processUserChunk($userChunk)
    {
        DB::transaction(function () use ($userChunk) {
            foreach ($userChunk as $ghlUser) {
                // Process each user in the chunk
                $this->updateOrCreateUser($ghlUser);
            }
        });
    }


    #[On('echo-private:company.{company.id},UserStatusEvent')]
    public function onUserStatusEvent($data)
    {
        logger('onUserStatusEvent');
        $this->dispatch('user-status', app: [
            "User List Component" => [
                "value" => $data
            ]
        ]);
    }

    public function render()
    {
    logger('rerendering');
        return view('livewire.pages.editor');
    }
}
