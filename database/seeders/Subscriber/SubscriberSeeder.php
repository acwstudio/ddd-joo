<?php

declare(strict_types=1);

namespace Database\Seeders\Subscriber;

use Database\Seeders\DatabaseSeeder;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Tag;
use Illuminate\Support\Collection;

final class SubscriberSeeder extends DatabaseSeeder
{
    public function run(): void
    {
        $demoUser = $this->demoUser();

        $tags = $this->tags()->map(fn (string $title) =>
        Tag::factory(compact('title'))->for($demoUser)->create()
        );

        $forms = $this->forms()->map(fn (string $title) =>
        Form::factory(compact('title'))->for($demoUser)->create()
        );
    }

    /**
     * @return Collection<string>
     */
    private function tags(): Collection
    {
        return collect([
            'Laravel', 'Vue', 'MySQL', 'Inertia', 'DDD', 'TDD', 'Clean Code', 'Microservices', 'Docker',
        ]);
    }

    /**
     * @return Collection<string>
     */
    private function forms(): Collection
    {
        return collect([
            'Waiting List', 'Join The Newsletter', 'Free Tutorial',
        ]);
    }

    private function byChance(float $chance, Collection $items, callable $action): mixed
    {
        return rand(0, 100) <= $chance * 100
            ? $action($items)
            : null;
    }

    private function range(int $from, int $to): Collection
    {
        return collect(range($from, $to));
    }

    private function last30Days(): Carbon
    {
        return now()->subDays(rand(0, 30));
    }
}
