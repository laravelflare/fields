<?php

namespace LaravelFlare\Fields;

use LaravelFlare\Flare\Flare;
use LaravelFlare\Fields\Types\BaseField;

class FieldManager
{
    /**
     * Flare.
     *
     * @var Flare
     */
    protected $flare;

    /**
     * __construct.
     *
     * @param Flare $flare
     */
    public function __construct(Flare $flare)
    {
        $this->flare = $flare;
    }

    /**
     * Create a new Field Instance.
     *
     * @param string $type
     * @param string $action
     * @param string $attribute
     * @param string $field
     * @param array  $options
     */
    public function create($type, $attribute, $value = null, $options = [])
    {
        if ($this->typeExists($type)) {
            $fieldType = $this->resolveField($type);

            return new $fieldType($type, $attribute, $value, $options);
        }

        return new BaseField($type, $attribute, $value, $options);
    }

    /**
     * Render a Field.
     *
     * @param string $type
     * @param string $attribute
     * @param string $field
     * @param string $options
     *
     * @return \Illuminate\Http\Response
     */
    public function render($action, $type, $attribute, $value = null, $options = [])
    {
        if (!isset($type)) {
            throw new \Exception('Field Type cannot be empty or undefined.');
        }

        return call_user_func_array([$this->create($type, $attribute, $value, $options), camel_case('render_'.$action)], []);
    }

    /**
     * Determines if a Field type class exists or not.
     *
     * @param string $type
     *
     * @return bool
     */
    public function typeExists($type)
    {
        return $this->resolveField($type) ? true : false;
    }

    /**
     * Returns an array of all of the available Field Types.
     *
     * @return array
     */
    public function availableTypes()
    {
        $fields = [];

        foreach ($this->config()['types'] as $type => $classname) {
            $fields = array_add($fields, $type, $classname);
        }

        return $fields;
    }

    /**
     * Return the Fields Config.
     * 
     * @return array
     */
    public function config()
    {
        return $this->flare->config('fields');
    }

    /**
     * Resolves the Class of a Field and returns it as a string.
     *
     * @param string $type
     *
     * @return string
     */
    private function resolveField($type)
    {
        if (array_key_exists($type, $this->availableTypes())) {
            return $this->availableTypes()[$type];
        }

        if (class_exists($type)) {
            return $type;
        }

        return false;
    }
}
