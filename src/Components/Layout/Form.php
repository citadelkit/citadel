<?php

namespace Citadel\Components\Layout;

use Citadel\Core\Wrapper;

class Form extends Wrapper
{
    protected $before_submit = null;

    public function data()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'before_submit' => $this->before_submit, // now set by beforeSubmit()
            'style' => [
                'class' => $this->class,
                'columns' => $this->getColumnClass(),
                'colspan' => $this->getColspanClass(),
                'align' => $this->getAlignClass(),
                'custom' => $this->style,
            ]
        ];
    }

     public function beforeSubmit(array $test)
    {
        if (empty($test)) {
            $this->before_submit = null;
        } else {
            $this->before_submit = [
                'confirm' => true,
                'config' => [
                    'icon' => $test['icon'] ?? 'info',
                    'html' => $test['html']  ?? 'Are you sure you want to submit this?',
                    'title' => $test['title'] ?? 'Please Confirm',
                    'showCancelButton' => $test['showCancelButton'] ?? true,
                    'confirmButtonText' => $test['confirmButtonText'] ?? 'Yes',
                    'cancelButtonText' => $test['cancelButtonText'] ?? 'Cancel'
                ]
            ];
        }

        return $this; // allow chaining
    }

    public function backbone()
    {
        return view("citadel-component::form", $this->data())
            ->with('html', $this->renderSchema());
    }
}
