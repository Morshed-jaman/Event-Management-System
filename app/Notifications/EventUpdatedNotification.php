<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventUpdatedNotification extends Notification
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Store notification in the database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Event Updated',
            'message' => 'The event "' . $this->event->title . '" has been updated.',
            'event_id' => $this->event->id,
            'url' => route('events.show', $this->event->id),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'event_title' => $this->event->title,
            'event_start_date' => $this->event->start_date,
            'event_end_date' => $this->event->end_date,
            'event_location' => $this->event->venue->name ?? 'No Venue',
            'event_id' => $this->event->id,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The event "' . $this->event->title . '" has been updated.')
            ->line('New Date: ' . $this->event->start_date . ' to ' . $this->event->end_date)
            ->line('Location: ' . ($this->event->venue->name ?? 'No Venue'))
            ->action('View Event', route('events.show', $this->event->id))
            ->line('Thank you for using our application!');
    }
}
