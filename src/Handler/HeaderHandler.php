<?php

namespace Citadel\Handler;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class HeaderHandler
{
    public function data()
    {
        return view('citadel-template::dash.header')
            ->with('notifications', $this->notifications())
            ->with('user', $this->user());
    }

    public function user()
    {
        $user = Auth::user();
        return [
            "name" => $user->name ?? $user->fullname,
            "id" => $user->id,
            "image" => $user->foto_url,
        ];
    }
    
    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->selectRaw("title, body as message, redirect_to, id")
            ->limit(5)
            ->get()
            ->toArray();
        return $notifications;
        return [
            ['title' => 'Rishi Chopra', 'message' => 'Mauris blandit erat id nunc blandit...'],
            ['title' => 'Neha Kannned', 'message' => 'Proin at elit vel est...'],
            ['title' => 'Nirmala Chauhan', 'message' => 'Morbi maximus urna...'],
            ['title' => 'Sina Ray', 'message' => 'Sed aliquam augue sit amet...'],
        ];
    }
}
