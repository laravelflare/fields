<?php

namespace LaravelFlare\Fields\Types;

use Illuminate\Support\HtmlString;
use LaravelFlare\Flare\Admin\Models\ModelAdmin;

class BaseField
{
    /**
     * Field Type Constant.
     */
    const FIELD_TYPE = '';

    /**
     * View Path for this Field Type
     *     Defaults to flare::fields which outputs
     *     a warning callout notifying the user that the field
     *     view does not yet exist.
     *     
     * @var string
     */
    protected $viewpath = 'flare::fields';

    /**
     * Field.
     * 
     * @var string
     */
    protected $field;

    /**
     * Attribute.
     * 
     * @var mixed
     */
    protected $attribute;

    /**
     * Value.
     * 
     * @var mixed
     */
    protected $value;

    /**
     * Options.
     * 
     * @var mixed
     */
    protected $options;

    /**
     * __construct.
     * 
     * @param string $field
     * @param string $attribute
     * @param string $value
     * @param string $modelManager
     */
    public function __construct($field, $attribute, $value, $options = [])
    {
        $this->field = $field;
        $this->attribute = $attribute;
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * Returns the View to Render as an HTMLString
     * 
     * @param  boolean $view 
     * 
     * @return /Illuminate/Support/String
     */
    public function render($view = false)
    {
        if (method_exists($this, $method = 'render'.ucfirst($view))) {
            return new HtmlString(
                call_user_func_array([$this, $method], [])
            );
        }
    }

    /**
     * Renders the Add (Create) Field View.
     * 
     * @return \Illuminate\View\View
     */
    public function renderAdd()
    {
        return view($this->viewpath.'.add', $this->viewData());
    }

    /**
     * Renders the Edit (Update) Field View.
     * 
     * @return \Illuminate\View\View
     */
    public function renderEdit()
    {
        return view($this->viewpath.'.edit', $this->viewData());
    }

    /**
     * Renders the Clone (Update) Field View.
     * 
     * @return \Illuminate\View\View
     */
    public function renderClone()
    {
        if (view()->exists($this->viewpath.'.clone')) {
            view($this->viewpath.'.clone', $this->viewData());
        }

        return view($this->viewpath.'.edit', $this->viewData());
    }

    /**
     * Renders the Viewable Field View.
     * 
     * @return \Illuminate\View\View
     */
    public function renderView()
    {
        return view($this->viewpath.'.view', $this->viewData());
    }

    /**
     * Getter for Field.
     * 
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Getter for Attribute.
     * 
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Returns the current value
     * 
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the old or current value
     * 
     * @return mixed
     */
    public function getOldValue()
    {
        return old($this->attribute, $this->getValue());
    }

    /**
     * Gets Field Options if they are defined.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Acessor for Field Type converted to Title Case.
     * 
     * @return string
     */
    public function getFieldType()
    {
        return title_case($this->getField() ? $this->getField() : self::FIELD_TYPE);
    }

    /*
     * Acessor for Field Title converted to Title Case with Spaces.
     * 
     * @return string
     */
    public function getAttributeTitle()
    {
        return str_replace('_', ' ', title_case($this->getAttribute()));
    }

    /**
     * Returns all of the accessible data for the Attirbute View
     *
     * @return array
     */
    protected function viewData()
    {
        return [
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
