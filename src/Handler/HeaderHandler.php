<?php

namespace Citadel\Handler;

use Faker\Factory;

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
        $faker = Factory::create();

        return [
            "name" => $faker->name,
            "id" => $faker->numberBetween(0, 100),
            "image" => "https://picsum.photos/200",
        ];
    }
    
    public function notifications()
    {
        return [
            ['title' => 'Rishi Chopra', 'message' => 'Mauris blandit erat id nunc blandit...'],
            ['title' => 'Neha Kannned', 'message' => 'Proin at elit vel est...'],
            ['title' => 'Nirmala Chauhan', 'message' => 'Morbi maximus urna...'],
            ['title' => 'Sina Ray', 'message' => 'Sed aliquam augue sit amet...'],
        ];
    }
}
