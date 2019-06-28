<?php

namespace Marcusvbda\InputMask;

use Laravel\Nova\Fields\Field;

class InputMask extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'InputMask';

    public function mask(String $mask = '')
    {
        return $this->withMeta([__FUNCTION__ => $mask]);
    }

    /**
     * Set raw mode when save
     *  TRUE    Send value without mask ( RAW )
     *  FALSE   Send value with mask
     *
     * @param  bool  $raw
     * @return $this
     */
    public function raw(bool $raw = true)
    {
        return $this->withMeta([__FUNCTION__ => $raw]);
    }
}
