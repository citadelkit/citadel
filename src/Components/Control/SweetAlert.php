<?php

namespace Citadel\Components\Control;

use Citadel\Core\Component;
use Citadel\Core\Traits\HasIcon;
use Citadel\Core\Traits\HasView;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Traits\Conditionable;
use JsonSerializable;

class SweetAlert extends Component implements JsonSerializable
{
    use Conditionable, HasIcon, HasView;

    protected $config = [];
    protected string $text = '';
    protected array $buttons = []; // Can be a boolean or array of options
    protected int $timer = 0; // in milliseconds
    protected string $width = 'auto';
    protected string $padding = '1.25rem';
    protected string $background = '#fff';
    protected string $position = 'center'; // Possible values: 'top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end'
    protected bool $showConfirmButton = true;
    protected string $confirmButtonText = 'OK';
    protected string $confirmButtonColor = '#3085d6';
    protected bool $showCancelButton = false;
    protected string $cancelButtonText = 'Cancel';
    protected string $cancelButtonColor = '#d33';
    protected bool $allowOutsideClick = true;
    protected bool $allowEscapeKey = true;
    protected bool $allowEnterKey = true;
    protected string $input = ''; // Possible values: 'text', 'email', 'password', 'number', 'tel', 'range', 'textarea', 'select', 'radio', 'checkbox', 'file', 'url'
    protected string $inputPlaceholder = '';
    protected string $inputValue = '';
    protected string $customClass = '';
    protected string $footer = '';
    protected string $content = '';

    protected string $after_confirm = 'none';
    protected $after_confirm_args = null;

    protected array $additional_data = [];

    public function config(array $config)
    {
        $this->config = $config;
        return $this;
    }

    public function afterConfirm($action = 'none', $args = null)
    {
        $this->after_confirm = $action;
        // if ($args instanceof InteractiveComponent) {
        //     $args = $args->compile(false);
        // }
        $this->after_confirm_args = $args;
        return $this;
    }

    public function renderView($view = null) {
        if($view) {
            $view = $this->view;
            $this->additional_data['sections'] = $view->renderSections();
            $html = $view->render();
        } else {
            $html = $this->content;
        }

        return sprintf("<div class='pt-2 px-2'>%s</div>", $html);
    }

    public function getData()
    {
        $hideOnUsingView = empty($this->view);
        return [
            'method' => 'fire',
            'id' => $this->name,
            'name' => $this->name,
            'after_confirm' => $this->after_confirm,
            'after_confirm_args' => $this->after_confirm_args,
            'config' => array_merge(
                [
                    'type' => $this->icon !='help_outline' ? $this->icon : "info",
                    'icon' => $this->icon !='help_outline' ? $this->icon : "info",
                    'title' => $this->title,
                    'titleText' => $this->title,
                    'html' => $this->renderView($this->view),
                    'text' => $this->title,
                    // 'buttons' => $this->buttons,
                    'timer' => $this->timer,
                    'width' => $this->width,
                    'padding' => $this->padding,
                    'background' => $this->background,
                    'position' => $this->position,
                    'showConfirmButton' => boolval($this->showConfirmButton),
                    'confirmButtonText' => $this->confirmButtonText,
                    'confirmButtonColor' => $this->confirmButtonColor,
                    'showCancelButton' => boolval($this->showCancelButton),
                    'cancelButtonText' => $this->cancelButtonText,
                    'cancelButtonColor' => $this->cancelButtonColor,
                    'allowOutsideClick' => $this->allowOutsideClick,
                    'allowEscapeKey' => $this->allowEscapeKey,
                    'allowEnterKey' => $this->allowEnterKey,
                    'input' => $this->input,
                    'inputPlaceholder' => $this->inputPlaceholder,
                    'inputValue' => $this->inputValue,
                    'customClass' => $this->customClass,
                    'footer' => $this->footer,
                ],
                $this->config,
                $this->additional_data,
            ),
        ];
    }

    public function buttons($buttons = [])
    {
        $this->buttons = $buttons;
        return $this;
    }

    public function timer($timer = 0)
    {
        $this->timer = $timer;
        return $this;
    }

    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    public function padding($padding = '1.25rem')
    {
        $this->padding = $padding;
        return $this;
    }

    public function background($background = '#fff')
    {
        $this->background = $background;
        return $this;
    }

    public function position($position = 'center')
    {
        $this->position = $position;
        return $this;
    }

    public function showConfirmButton($showConfirmButton = true)
    {
        $this->showConfirmButton = $showConfirmButton;
        return $this;
    }

    public function confirmButtonText($confirmButtonText = 'OK')
    {
        $this->confirmButtonText = $confirmButtonText;
        return $this;
    }

    public function confirmButtonColor($confirmButtonColor = '#3085d6')
    {
        $this->confirmButtonColor = $confirmButtonColor;
        return $this;
    }

    public function showCancelButton($showCancelButton = true)
    {
        $this->showCancelButton = $showCancelButton;
        return $this;
    }

    public function cancelButtonText($cancelButtonText = 'Cancel')
    {
        $this->cancelButtonText = $cancelButtonText;
        return $this;
    }

    public function cancelButtonColor($cancelButtonColor = '#d33')
    {
        $this->cancelButtonColor = $cancelButtonColor;
        return $this;
    }

    public function allowOutsideClick($allowOutsideClick = true)
    {
        $this->allowOutsideClick = $allowOutsideClick;
        return $this;
    }

    public function allowEscapeKey($allowEscapeKey = true)
    {
        $this->allowEscapeKey = $allowEscapeKey;
        return $this;
    }

    public function allowEnterKey($allowEnterKey = true)
    {
        $this->allowEnterKey = $allowEnterKey;
        return $this;
    }

    public function input($input = '')
    {
        $this->input = $input;
        return $this;
    }

    public function inputPlaceholder($inputPlaceholder = '')
    {
        $this->inputPlaceholder = $inputPlaceholder;
        return $this;
    }

    public function inputValue($inputValue = '')
    {
        $this->inputValue = $inputValue;
        return $this;
    }

    public function customClass($customClass = '')
    {
        $this->customClass = $customClass;
        return $this;
    }

    public function footer($footer = '')
    {
        $this->footer = $footer;
        return $this;
    }

    public function content($content = '')
    {
        $this->content = $content;
        return $this;
    }

    public function compile($encode = true)
    {
        $data = [
            'sweet_alert' => $this->getData(),
        ];
        if (!$encode) {
            return $data;
        }
        return json_encode($data);
    }

    public function jsonSerialize(): mixed {
        return [
            'component' => 'sweetalert',
            'args' => $this->getData()
        ];
    }
}
