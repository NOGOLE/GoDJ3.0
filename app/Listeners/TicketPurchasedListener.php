<?php

namespace App\Listeners;
use Mail;
use App\Events\TicketPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketPurchasedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketPurchased  $event
     * @return void
     */
    public function handle(TicketPurchased $event)
    {
        //
        $email = $event->request->email;
        Mail::send('emails.ticket', ['request' => $request, 'party' => \App\Party::find($request->party_id)], function ($m) use ($email) {
            $m->from('tickets@godj.online', 'GoDJ');

            $m->to($email)->subject('Your GoDJ Purchase.');
        });
    }
}
