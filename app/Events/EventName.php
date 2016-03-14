<?php 
namespace App\Events;

use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Auth;

class EventName extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct()
    {
        if (Auth::check()) {
            $this->data = array(
                'power'=> Auth::id()
            );
        } else {
            $this->data = array(
                'power'=> '0'
            );
        }

    }

    public function broadcastOn()
    {
        return ['test-channel'];
    }
}