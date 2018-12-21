<?php

namespace App\Events\Api\V1\Loan\Proposal;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProposalRequestedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loanProposal;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($loanProposal)
    {
        $this->loanProposal = $loanProposal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Todo : Create private or public channel for websocket
        return new PrivateChannel('channel-name');
    }
}
