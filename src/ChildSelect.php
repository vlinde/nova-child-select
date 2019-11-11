<?php

namespace Vlinde\ChildSelect;

use Laravel\Nova\Fields\Field;
use Vlinde\NovaPageBuilder\Models\VldBlockTemplate;

class ChildSelect extends Field
{
    public $component = 'child-select';

    protected $options, $model, $column;

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    public function model($model) {
        $this->model = $model;

        return $this;
    }

    public function getOptions($parameters = [])
    {

        $options = $this->model::where($this->column, $parameters)->get();

        $result = [];
        foreach ($options as $key => $option) {
            $result[] = [
                'label' => $option->name,
                'value' => $option->id,
            ];
        }

        return $result;
    }

    public function parent($attribute)
    {
        $this->column = $attribute;
        $this->withMeta(['parentAttribute' => $attribute]);
        return $this;
    }
}
