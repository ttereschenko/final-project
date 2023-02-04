<?php

namespace App\Console\Commands;

use App\Models\User;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create-admin {name} {surname} {phone} {email} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User-Admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->argument('name');
        $surname = $this->argument('surname');
        $phone = $this->argument('phone');

        if (!$password) {
            $password = Str::random(8);
        }

        if (User::query()->where('email', $email)->exists()) {
            $this->error('User already exists');
            return self::FAILURE;
        }

        $user = new User();
        $user->name = $name;
        $user->surname = $surname;
        $user->phone = $phone;
        $user->email = $email;
        $user->password = $password;
        $user->role = User::ROLE_ADMIN;
        $user->email_verified_at = new DateTime();
        $user->save();

        if (!$this->argument('password')) {
            $this->info(sprintf('Your password: %s', $password));
        }

        return self::SUCCESS;
    }
}
