<?php

namespace App\Services;

use App\Mail\SubscriberNotification;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class NotifySubscribers
{
    /**
     * Send a notification to all active subscribers.
     */
    public static function send(string $subject, string $heading, string $body, ?string $buttonText = null, ?string $buttonUrl = null): int
    {
        $subscribers = Subscriber::active()->get();
        $count = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->queue(
                    new SubscriberNotification($subject, $heading, $body, $buttonText, $buttonUrl, $subscriber)
                );
                $count++;
            } catch (\Exception $e) {
                // Skip failed sends
                continue;
            }
        }

        return $count;
    }
}
