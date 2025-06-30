<?php

namespace Citadel\Components\Form;

use App\Services\Citadel\Citadel;
use Citadel\Components\Control\SweetAlert;
use Citadel\Core\Component;
use Illuminate\Support\Facades\Storage;

class UploadInput extends Component
{

    protected $placeholder = "Upload";
    // protected $column_width;
    // protected $input_layout = "vertical";
    protected $depend_on;
    protected $files = [];
    protected $multiple = false;
    protected $maxsize = "10MB";
    protected $hidden = false;
    protected $acceptedFileTypes = [];

    public function files(string|array|null $filepaths = "")
    {
        if (empty($filepaths)) {
            return $this;
        }
        $this->files = collect((is_array($filepaths)) ? $filepaths : [$filepaths])
            ->map(function ($path) {
                return [
                    'source' => $path,
                    'options' => [
                        'type' => 'local'
                    ]
                ];
            });
        return $this;
    }

    public function multiple($maxsize)
    {
        $this->maxsize = $maxsize;
        return $this;
    }

    public function maxsize($maxsize)
    {
        $this->maxsize = $maxsize;
        return $this;
    }


    /**example
     *
     *  'application/pdf',
        'application/msword', // .doc

     fileTypes(['application/pdf'])
     */
    public function fileTypes(array $types)
    {
        $this->acceptedFileTypes = $types;
        return $this;
    }

    public function fileTypeLabels()
    {

        $mimeMap = [
            'application/pdf' => 'PDF',
            'application/msword' => 'DOC',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'DOCX',
            'image/jpeg' => 'JPG/JPEG',
            'image/png' => 'PNG',
            'image/gif' => 'GIF',
            'image/webp' => 'WEBP',
            'image/bmp' => 'BMP',
            'image/svg+xml' => 'SVG',
        ];

        $labels = collect($this->acceptedFileTypes)
            ->map(function ($mime) use ($mimeMap) {
                return $mimeMap[$mime] ?? $mime;
            })
            ->unique()
            ->values()
            ->implode(', ');
        return $labels;
    }

    public function data()
    {
        return [
            "title" => $this->title,
            'name' => $this->name,
            // 'input_layout' => $this->input_layout,
            'placeholder' => $this->placeholder,
            // 'column_width' => $this->column_width,
            // 'depend_on' => $this->depend_on,
            'files' => $this->files,
            'file_labels' => $this->fileTypeLabels(),
            "hidden" => $this->hidden,
            'server' => [
                'process' => route('citadel.filepond.process'),
                'load' => route('citadel.filepond.load') . '?filepath=',
            ],
            'config' => [
                'multiple' => $this->multiple,
                'max_size' => $this->maxsize, //
                'accepted_file_types' => $this->acceptedFileTypes ?: null,
                'accepted_file_labels' =>  !empty($this->fileTypeLabels())  ?  "Hanya Menerima ({$this->fileTypeLabels()}) "  : '',
                'labels_file_type_not_allowed' => !empty($this->fileTypeLabels())  ?  "Selain ({$this->fileTypeLabels()}) tidak di izinkan."  :'',
            ],
            "style" => [
                "colspan" => $this->getColspanClass()
            ],
        ];
    }


    public function dependOn($depend_on)
    {
        $this->depend_on = $depend_on;
        return $this;
    }

    public function backbone()
    {
        return view("citadel-component::file_upload", $this->data());
    }


    public function hidden($hidden = true)
    {

        if (is_callable($hidden)) {
            $hidden = call_user_func($hidden, $this);
        }
        $this->hidden = $hidden;
        return $this;
    }
}
