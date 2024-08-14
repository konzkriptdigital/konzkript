<?php

use Livewire\Volt\Component;
use App\Events\ChatEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\on;


new class extends Component {
    public string $message = '';
    public array $messages = [];

    public function sendChat ()
    {
        ChatEvent::dispatch(Auth::user()->name, $this->message, Auth::user());
        $this->reset('message');
    }

    #[On('echo:chat,ChatEvent')]
    public function onChatEvent ($event)
    {
        $this->messages[] = $event;
    }
}; ?>

<div>
    <x-chat-dialog :messages="$this->messages" toMethod="sendChat" color="blue" name="Chat" />
</div>
