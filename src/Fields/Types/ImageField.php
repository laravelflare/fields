<?php

namespace LaravelFlare\Fields\Types;

class ImageField extends BaseField
{
    /**
     * View Path for this Field Type
     *     Defaults to flare::fields which outputs
     *     a warning callout notifying the user that the field
     *     view does not yet exist.
     *
     * @var string
     */
    protected $viewpath = 'flare::fields.image';
}
