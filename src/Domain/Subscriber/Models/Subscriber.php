<?php

declare(strict_types=1);

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Domain\Subscriber\Builders\SubscriberBuilder;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Spatie\LaravelData\Contracts\DataObject;
use Spatie\LaravelData\WithData;

final class Subscriber extends BaseModel
{
    use Notifiable;
    use WithData;
    use HasUser;

    protected string $dataClass = SubscriberData::class;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'form_id',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public static function query(): SubscriberBuilder|Builder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): SubscriberBuilder
    {
        return new SubscriberBuilder($query);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function broadcasts(): BelongsToMany
    {
        //        return $this->belongsToMany(Broadcast::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class)
            ->withDefault();
    }

    public function received_mails(): HasMany
    {
        //        return $this->hasMany(SentMail::class);
    }

    public function last_received_mail(): HasOne
    {
        //        return $this->hasOne(SentMail::class)
        //            ->latestOfMany()
        //            ->withDefault();
    }

    public function sequences(): BelongsToMany
    {
        //        return $this->belongsToMany(Sequence::class)->withPivot('subscribed_at');
    }

    public function sent_mails(): HasMany
    {
        //        return $this->hasMany(SentMail::class);
    }

    //    public function tooEarlyFor(SequenceMail $mail): bool
    //    {
    //        return !$mail->enoughTimePassedSince($this->last_received_mail);
    //    }

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }
}
