<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Automation\AutomationSeeder;
use Database\Seeders\Mail\BroadcastSeeder;
use Database\Seeders\Mail\SequenceSeeder;
use Database\Seeders\Subscriber\SubscriberSeeder;
use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    private const DEMO_USER_EMAIL = 'demo@mailtool.biz';

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Tag::truncate();
        Form::truncate();
        Schema::enableForeignKeyConstraints();

        User::factory([
            'name' => 'Demo User',
            'email' => self::DEMO_USER_EMAIL,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->create();

        $this->call([
            SubscriberSeeder::class,
//            BroadcastSeeder::class,
//            SequenceSeeder::class,
//            AutomationSeeder::class,
        ]);
    }

    protected function demoUser(): User
    {
        return User::whereEmail(self::DEMO_USER_EMAIL)->firstOrFail();
    }

    protected function tagId(string $title): int
    {
        return Tag::whereTitle($title)->firstOrFail()->id;
    }

    protected function formId(string $title): int
    {
        return Form::whereTitle($title)->firstOrFail()->id;
    }
}
