<?php

namespace App\Policies;

use App\LetterReminder;
use App\OutgoingLetter;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LetterReminderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any letter reminders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view letter reminders');
    }

    /**
     * Determine whether the user can view the letter reminder.
     *
     * @param  \App\User  $user
     * @param  \App\LetterReminder  $letterReminder
     * @return mixed
     */
    public function view(User $user, LetterReminder $letterReminder)
    {
        return $user->can('view letter reminders');
    }

    /**
     * Determine whether the user can create letter reminders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, OutgoingLetter $letter)
    {
        return $user->can('create letter reminders')
            && $letter->creator_id == $user->id;
    }

    /**
     * Determine whether the user can update the letter reminder.
     *
     * @param  \App\User  $user
     * @param  \App\LetterReminder  $letterReminder
     * @return mixed
     */
    public function update(User $user, LetterReminder $letterReminder)
    {
        return $user->can('edit letter reminders')
            && $letterReminder->letter->creator_id == $user->id;
    }

    /**
     * Determine whether the user can delete the letter reminder.
     *
     * @param  \App\User  $user
     * @param  \App\LetterReminder  $letterReminder
     * @return mixed
     */
    public function delete(User $user, LetterReminder $letterReminder)
    {
        return $user->can('delete letter reminders')
            && $letterReminder->letter->creator_id == $user->id;
    }
}