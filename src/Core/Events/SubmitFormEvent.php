<?php

namespace Citadel\Core\Events;

class SubmitFormEvent extends CitadelEvent
{
    public static function make()
    {
        
    }

    public function __construct(
        protected $event,
        protected $form_name = ""
    )
    {}
}
