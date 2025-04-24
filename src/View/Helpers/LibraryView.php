<?php

namespace Citadel\View\Helpers;

/**
 * Centralized View template
 *
 * Directory of reusable view component pages for projects
 *
 */
class LibraryView
{
    protected $data;

    public function __construct($view, $data = [], $sectionTitle = "Tab")
    {
        $this->data = compact('view', 'data', 'sectionTitle');
    }

    public function getData()
    {
        return $this->data;
    }
}