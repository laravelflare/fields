<?php

use LaravelFlare\Fields\FieldManager;
use LaravelFlare\Fields\Types\TextField;
use Illuminate\Contracts\View\Factory as ViewFactory;

class TextFieldTest extends BaseTest
{
    protected $fieldManager;

    public function test_text_field_render_methods()
    {
        $this->setupField('text', TextField::class);

        $this->assertContains('<label class="control-label" for="new_attribute">', $this->fieldManager->render('add', 'text', 'new_attribute', null, [])->render());
        $this->assertContains('<label class="control-label" for="new_attribute">', $this->fieldManager->render('edit', 'text', 'new_attribute', null, [])->render());
        $this->assertContains('<label class="control-label" for="new_attribute">', $this->fieldManager->render('clone', 'text', 'new_attribute', null, [])->render());
        $this->assertContains('New Attribute', $this->fieldManager->render('view', 'text', 'new_attribute', null, [])->render());
    }

    public function test_text_field_attribute_title()
    {
        $this->setupField('text', TextField::class);

        $this->assertContains('Attribute Title', $this->fieldManager->render('add', 'text', 'attribute_title', null, [])->render());
        $this->assertContains('Attribute Title', $this->fieldManager->render('edit', 'text', 'attribute_title', null, [])->render());
        $this->assertContains('Attribute Title', $this->fieldManager->render('clone', 'text', 'attribute_title', null, [])->render());
        $this->assertContains('Attribute Title', $this->fieldManager->render('view', 'text', 'attribute_title', null, [])->render());
    }

    public function test_text_field_is_required()
    {
        $this->setupField('text', TextField::class);

        $options = ['required' => true];

        $this->assertContains('required="required"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('required="required"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('required="required"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $this->assertContains('This field is required', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('This field is required', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('This field is required', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_tooltip()
    {
        $this->setupField('text', TextField::class);

        $options = ['tooltip' => null];

        $this->assertNotContains('data-toggle="tooltip"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-toggle="tooltip"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-toggle="tooltip"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['tooltip' => 'This is the Attribute Title Field.'];

        $this->assertContains('data-original-title="This is the Attribute Title Field."', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-original-title="This is the Attribute Title Field."', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-original-title="This is the Attribute Title Field."', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_with_defined_classes()
    {
        $this->setupField('text', TextField::class);

        $options = ['class' => null];

        $this->assertContains('class="form-control "', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control "', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control "', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['class' => 'example-class another-class'];

        $this->assertContains('class="form-control example-class another-class"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control example-class another-class"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control example-class another-class"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_maxlength()
    {      
        $this->setupField('text', TextField::class);

        $options = ['maxlength' => null];

        $this->assertNotContains('maxlength', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('maxlength', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('maxlength', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['maxlength' => 30];

        $this->assertContains('maxlength="30"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('maxlength="30"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('maxlength="30"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_is_disabled()
    {
        $this->setupField('text', TextField::class);

        $options = ['disabled' => null];

        $this->assertNotContains('disabled', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('disabled', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('disabled', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['disabled' => true];

        $this->assertContains('disabled="disabled"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('disabled="disabled"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('disabled="disabled"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_is_readonly()
    {
        $this->setupField('text', TextField::class);

        $options = ['readonly' => null];

        $this->assertNotContains('readonly', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('readonly', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('readonly', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['readonly' => true];

        $this->assertContains('readonly="readonly"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('readonly="readonly"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('readonly="readonly"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_autocomplete()
    {        
        $this->setupField('text', TextField::class);

        $options = ['autocomplete' => null];

        $this->assertNotContains('autocomplete', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('autocomplete', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('autocomplete', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['autocomplete' => false];

        $this->assertContains('autocomplete="off"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('autocomplete="off"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('autocomplete="off"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['autocomplete' => true];

        $this->assertContains('autocomplete="on"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('autocomplete="on"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('autocomplete="on"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_autofocus()
    {
        $this->setupField('text', TextField::class);

        $options = ['autofocus' => null];

        $this->assertNotContains('autofocus', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('autofocus', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('autofocus', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['autofocus' => true];

        $this->assertContains('autofocus="autofocus"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('autofocus="autofocus"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('autofocus="autofocus"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_pattern()
    {
        $this->setupField('text', TextField::class);

        $options = ['pattern' => null];

        $this->assertNotContains('pattern', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('pattern', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('pattern', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['pattern' => '[A-Za-z]{3}'];

        $this->assertContains('pattern="[A-Za-z]{3}"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('pattern="[A-Za-z]{3}"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('pattern="[A-Za-z]{3}"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_input_mask()
    {
        $this->setupField('text', TextField::class);

        $options = ['data-inputmask' => null];

        $this->assertNotContains('data-mask', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-mask', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-mask', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-inputmask', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-inputmask', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-inputmask', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['data-inputmask' => "'alias': 'date'"];

        $this->assertContains('data-mask=""', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-mask=""', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-mask=""', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-inputmask="\'alias\': \'date\'"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-inputmask="\'alias\': \'date\'"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('data-inputmask="\'alias\': \'date\'"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_placeholder()
    {        
        $this->setupField('text', TextField::class);

        $options = ['placeholder' => null];

        $this->assertNotContains('placeholder', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('placeholder', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('placeholder', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['placeholder' => 'Input your Attribute Title'];

        $this->assertContains('placeholder="Input your Attribute Title"', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('placeholder="Input your Attribute Title"', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('placeholder="Input your Attribute Title"', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_has_value()
    {
        $this->setupField('text', TextField::class);

        $this->assertContains('value="Aden Fraser"', $this->fieldManager->render('add', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('value="Aden Fraser"', $this->fieldManager->render('edit', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('value="Aden Fraser"', $this->fieldManager->render('clone', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('Aden Fraser', $this->fieldManager->render('view', 'text', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_text_field_has_old_value()
    {
        $this->setupField('text', TextField::class);

        Request::session()->flash('_old_input', ['attribute_title' => 'Old Value']);

        $this->assertContains('value="Old Value"', $this->fieldManager->render('add', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('value="Old Value"', $this->fieldManager->render('edit', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('value="Old Value"', $this->fieldManager->render('clone', 'text', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_text_field_has_help_text()
    {      
        $this->setupField('text', TextField::class);

        $options = ['help' => null];

        $this->assertNotContains('help-block', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('help-block', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertNotContains('help-block', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());

        $options = ['help' => 'Please enter your <strong>Attribute Title</strong>'];

        $this->assertContains('<p class="help-block">Please enter your <strong>Attribute Title</strong></p>', $this->fieldManager->render('add', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('<p class="help-block">Please enter your <strong>Attribute Title</strong></p>', $this->fieldManager->render('edit', 'text', 'attribute_title', null, $options)->render());
        $this->assertContains('<p class="help-block">Please enter your <strong>Attribute Title</strong></p>', $this->fieldManager->render('clone', 'text', 'attribute_title', null, $options)->render());
    }

    public function test_text_field_displays_first_error()
    {
        $this->setupField('text', TextField::class);

        $this->setErrors('attribute_title', ['Error 1', 'Error 2']);

        $this->assertContains('Error 1', $this->fieldManager->render('add', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('Error 1', $this->fieldManager->render('edit', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('Error 1', $this->fieldManager->render('clone', 'text', 'attribute_title', 'Aden Fraser', [])->render());

        $this->assertNotContains('Error 2', $this->fieldManager->render('add', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertNotContains('Error 2', $this->fieldManager->render('edit', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertNotContains('Error 2', $this->fieldManager->render('clone', 'text', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_text_field_has_error_class()
    {
        $this->setupField('text', TextField::class);

        $this->setErrors('attribute_title', ['Error 1', 'Error 2']);

        $this->assertContains('<div class="form-group  has-error', $this->fieldManager->render('add', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<div class="form-group  has-error', $this->fieldManager->render('edit', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<div class="form-group  has-error', $this->fieldManager->render('clone', 'text', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_text_field_has_error_icon()
    {
        $this->setupField('text', TextField::class);

        $this->setErrors('attribute_title', ['Error 1', 'Error 2']);

        $this->assertContains('<i class="fa fa-times-circle-o"></i>', $this->fieldManager->render('add', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<i class="fa fa-times-circle-o"></i>', $this->fieldManager->render('edit', 'text', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<i class="fa fa-times-circle-o"></i>', $this->fieldManager->render('clone', 'text', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_text_field_has_confirmed_input()
    {
        $this->setupField('text', TextField::class);

        $options = ['confirmed' => true];

        $this->assertContains('<label class="control-label" for="new_attribute_confirmation">', $this->fieldManager->render('add', 'text', 'new_attribute', null, $options)->render());
        $this->assertContains('<label class="control-label" for="new_attribute_confirmation">', $this->fieldManager->render('edit', 'text', 'new_attribute', null, $options)->render());
        $this->assertContains('<label class="control-label" for="new_attribute_confirmation">', $this->fieldManager->render('clone', 'text', 'new_attribute', null, $options)->render());
    }       
}
