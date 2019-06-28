<?php

namespace Marcusvbda\CustomFields;

use Laravel\Nova\Fields\Field;

class CustomFields extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'CustomFields';

    public function type(String $type = 'text')
    {
        return $this->withMeta([__FUNCTION__ => $type]);
    }
    public function field_id($field_id = null)
    {
        return $this->withMeta([__FUNCTION__ => $field_id]);
    }
    
    public function values($values = null)
    {
        return $this->withMeta([__FUNCTION__ => $values]);
    }

    public function options($options = [])
    {
        return $this->withMeta([__FUNCTION__ => $options]);
    }

}
