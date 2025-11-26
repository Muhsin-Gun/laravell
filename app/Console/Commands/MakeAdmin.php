<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeAdmin extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = 'Promote a user (by email) to admin role';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->role = 'admin';
        $user->save();

        $this->info("User {$email} promoted to admin.");
        return 0;
    }
}
