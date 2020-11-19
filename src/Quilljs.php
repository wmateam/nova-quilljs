<?php

namespace Wmateam\NovaQuilljs;

use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Quilljs extends Trix
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'quilljs';


    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->tooltip();
        $this->height();
        $this->fullWidth();
        $this->maxFileSize(2);
        $this->withMeta([
            'options'=> config('quilljs'),
        ]);
    }
    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request,
                                                $requestAttribute,
                                                $model,
                                                $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = $request[$requestAttribute];
        }
    }

    public function tooltip(bool $value=false)
    {
        return $value == true ? $this->withMeta(['tooltip'=> config('tooltip') ?? []]) : null;
    }

    public function placeholder($text)
    {
        return $this->withMeta(['placeholder'=> $text]);
    }

    public function height(int $value=300)
    {
        return $this->withMeta(['height' => $value]);
    }

    public function fullWidth(bool $value=true)
    {
        return $this->withMeta(['width' => $value]);
    }

    public function maxFileSize(int $value = 2)
    {
        return $this->withMeta(['maxFileSize' => $value]);
    }
}
