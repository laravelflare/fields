<?php

namespace LaravelFlare\Fields\Types;

class MapField extends BaseField
{
    /**
     * View Path for this Field Type
     *     Defaults to flare::fields which outputs
     *     a warning callout notifying the user that the field
     *     view does not yet exist.
     *
     * @var string
     */
    protected $viewpath = 'flare::fields.map';

    /**
     * Returns all of the accessible data for the Attirbute View.
     *
     * @return array
     */
    protected function viewData()
    {
        $fieldConfig = app('flare')->fields()->config();
        
        return [
            'google_api_key' => array_get($fieldConfig, 'options.map.google_api_key', null),
            'field' => $this->getField(),
            'fieldType' => $this->getFieldType(),
            'attribute' => $this->getAttribute(),
            'attributeTitle' => $this->getAttributeTitle(),
            'value' => $this->getValue(),
            'oldValue' => $this->getOldValue(),
            'options' => $this->getOptions(),
        ];
    }
}
