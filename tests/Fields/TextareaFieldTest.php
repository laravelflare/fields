<?php

use LaravelFlare\Fields\FieldManager;
use LaravelFlare\Fields\Types\TextareaField;
use Illuminate\Contracts\View\Factory as ViewFactory;

class TextareaFieldTest extends BaseTest
{
    protected $fieldManager;

    public function test_textarea_field_render_methods()
    {
        $this->setupField('textarea', TextareaField::class);

        $this->assertContains('<textarea', $this->fieldManager->render('add', 'textarea', 'new_attribute', null, [])->render());
        $this->assertContains('<textarea', $this->fieldManager->render('edit', 'textarea', 'new_attribute', null, [])->render());
        $this->assertContains('<textarea', $this->fieldManager->render('clone', 'textarea', 'new_attribute', null, [])->render());
        $this->assertContains('New Attribute', $this->fieldManager->render('view', 'textarea', 'new_attribute', null, [])->render());
    }

    public function test_textarea_field_attribute_title()
    {
        $this->setupField('textarea', TextareaField::class);

        $this->assertContains('Attribute Title', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, [])->render());
        $this->assertContains('Attribute Title', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, [])->render());
        $this->assertContains('Attribute Title', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, [])->render());
        $this->assertContains('Attribute Title', $this->fieldManager->render('view', 'textarea', 'attribute_title', null, [])->render());
    }

    public function test_textarea_field_is_required()
    {
        $this->setupField('textarea', TextareaField::class);

        $options = ['required' => true];

        $this->assertContains('required="required"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('required="required"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('required="required"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $this->assertContains('This field is required', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('This field is required', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('This field is required', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_has_tooltip()
    {
        $this->setupField('textarea', TextareaField::class);

        $options = ['tooltip' => null];

        $this->assertNotContains('data-toggle="tooltip"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-toggle="tooltip"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('data-toggle="tooltip"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['tooltip' => 'This is the Attribute Title Field.'];

        $this->assertContains('data-original-title="This is the Attribute Title Field."', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('data-original-title="This is the Attribute Title Field."', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('data-original-title="This is the Attribute Title Field."', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_with_defined_classes()
    {
        $this->setupField('textarea', TextareaField::class);

        $options = ['class' => null];

        $this->assertContains('class="form-control "', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control "', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control "', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['class' => 'example-class another-class'];

        $this->assertContains('class="form-control example-class another-class"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control example-class another-class"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('class="form-control example-class another-class"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_has_maxlength()
    {      
        $this->setupField('textarea', TextareaField::class);

        $options = ['maxlength' => null];

        $this->assertNotContains('maxlength', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('maxlength', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('maxlength', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['maxlength' => 30];

        $this->assertContains('maxlength="30"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('maxlength="30"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('maxlength="30"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_is_disabled()
    {
        $this->setupField('textarea', TextareaField::class);

        $options = ['disabled' => null];

        $this->assertNotContains('disabled', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('disabled', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('disabled', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['disabled' => true];

        $this->assertContains('disabled="disabled"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('disabled="disabled"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('disabled="disabled"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_is_readonly()
    {
        $this->setupField('textarea', TextareaField::class);

        $options = ['readonly' => null];

        $this->assertNotContains('readonly', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('readonly', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('readonly', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['readonly' => true];

        $this->assertContains('readonly="readonly"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('readonly="readonly"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('readonly="readonly"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_has_autofocus()
    {
        $this->setupField('textarea', TextareaField::class);

        $options = ['autofocus' => null];

        $this->assertNotContains('autofocus', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('autofocus', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('autofocus', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['autofocus' => true];

        $this->assertContains('autofocus="autofocus"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('autofocus="autofocus"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('autofocus="autofocus"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_has_placeholder()
    {        
        $this->setupField('textarea', TextareaField::class);

        $options = ['placeholder' => null];

        $this->assertNotContains('placeholder', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('placeholder', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('placeholder', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['placeholder' => 'Input your Attribute Title'];

        $this->assertContains('placeholder="Input your Attribute Title"', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('placeholder="Input your Attribute Title"', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('placeholder="Input your Attribute Title"', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_has_help_text()
    {      
        $this->setupField('textarea', TextareaField::class);

        $options = ['help' => null];

        $this->assertNotContains('help-block', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('help-block', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertNotContains('help-block', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());

        $options = ['help' => 'Please enter your <strong>Attribute Title</strong>'];

        $this->assertContains('<p class="help-block">Please enter your <strong>Attribute Title</strong></p>', $this->fieldManager->render('add', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('<p class="help-block">Please enter your <strong>Attribute Title</strong></p>', $this->fieldManager->render('edit', 'textarea', 'attribute_title', null, $options)->render());
        $this->assertContains('<p class="help-block">Please enter your <strong>Attribute Title</strong></p>', $this->fieldManager->render('clone', 'textarea', 'attribute_title', null, $options)->render());
    }

    public function test_textarea_field_displays_first_error()
    {
        $this->setupField('textarea', TextareaField::class);

        $this->setErrors('attribute_title', ['Error 1', 'Error 2']);

        $this->assertContains('Error 1', $this->fieldManager->render('add', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('Error 1', $this->fieldManager->render('edit', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('Error 1', $this->fieldManager->render('clone', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());

        $this->assertNotContains('Error 2', $this->fieldManager->render('add', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertNotContains('Error 2', $this->fieldManager->render('edit', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertNotContains('Error 2', $this->fieldManager->render('clone', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_textarea_field_has_error_class()
    {
        $this->setupField('textarea', TextareaField::class);

        $this->setErrors('attribute_title', ['Error 1', 'Error 2']);

        $this->assertContains('<div class="form-group  has-error', $this->fieldManager->render('add', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<div class="form-group  has-error', $this->fieldManager->render('edit', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<div class="form-group  has-error', $this->fieldManager->render('clone', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
    }

    public function test_textarea_field_has_error_icon()
    {
        $this->setupField('textarea', TextareaField::class);

        $this->setErrors('attribute_title', ['Error 1', 'Error 2']);

        $this->assertContains('<i class="fa fa-times-circle-o"></i>', $this->fieldManager->render('add', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<i class="fa fa-times-circle-o"></i>', $this->fieldManager->render('edit', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
        $this->assertContains('<i class="fa fa-times-circle-o"></i>', $this->fieldManager->render('clone', 'textarea', 'attribute_title', 'Aden Fraser', [])->render());
    }   
}
