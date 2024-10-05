<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdatePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                if (!Hash::needsRehash($user->password)) {
                    $user->password = Hash::make($user->password);
                    $user->save();
                }
            }
        });
    
        $this->info('Passwords updated successfully.');
    }
}
