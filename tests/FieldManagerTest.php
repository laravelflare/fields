<?php

use LaravelFlare\Fields\FieldManager;
use LaravelFlare\Fields\Types\BaseField;
use LaravelFlare\Fields\Types\TextField;

/**
 * Tests the Field Manager Class and the generation
 * of Fields based on the BaseField class.
 */
class FieldManagerTest extends BaseTest
{
    protected $fieldManager;

    public function test_creating_a_field_that_does_not_exist()
    {
        $this->setupNoFieldTypes();
        $field = $this->fieldManager->create('text', 'attribute', null, []);

        $this->assertInstanceOf(BaseField::class, $field);
        $this->assertEquals('text', $field->getField());
        $this->assertEquals('attribute', $field->getAttribute());
        $this->assertNull($field->getValue());
        $this->assertEquals([], $field->getOptions());
        $this->assertEquals('Text', $field->getFieldType());
        $this->assertEquals('Attribute', $field->getAttributeTitle());
    }

    public function test_creating_a_new_field()
    {
        $this->setupTextAndPasswordFieldTypes();
        $field = $this->fieldManager->create('text', 'attribute', null, []);

        $this->assertInstanceOf(TextField::class, $field);
        $this->assertEquals('text', $field->getField());
        $this->assertEquals('attribute', $field->getAttribute());
        $this->assertNull($field->getValue());
        $this->assertEquals([], $field->getOptions());
        $this->assertEquals('Text', $field->getFieldType());
        $this->assertEquals('Attribute', $field->getAttributeTitle());
    }

    public function test_rendering_a_field_that_does_not_exist()
    {
        $this->setupNoFieldTypes();

        $this->assertContains('Text Field Type Missing!', $this->fieldManager->render('add', 'text', 'attribute', null, [])->render());
        $this->assertContains('Text Field Type Missing!', $this->fieldManager->render('edit', 'text', 'attribute', null, [])->render());
        $this->assertContains('Text Field Type Missing!', $this->fieldManager->render('clone', 'text', 'attribute', null, [])->render());
        $this->assertContains('Text Field Type Missing!', $this->fieldManager->render('view', 'text', 'attribute', null, [])->render());

        $this->setExpectedException(Exception::class, 'Field Type cannot be empty or undefined.');
        $this->fieldManager->render('add', null, 'attribute', null, [])->render();
    }

    public function test_rendering_a_field_that_does_exist()
    {
        $this->setupTextAndPasswordFieldTypes();

        $this->assertContains('<label class="control-label" for="attribute">', $this->fieldManager->create('text', 'attribute', null, [])->render('add')->toHtml()->render());
        $this->assertContains('<label class="control-label" for="attribute">', $this->fieldManager->create('text', 'attribute', null, [])->render('edit')->toHtml()->render());
        $this->assertContains('<label class="control-label" for="attribute">', $this->fieldManager->create('text', 'attribute', null, [])->render('clone')->toHtml()->render());
        $this->assertContains('Attribute', $this->fieldManager->create('text', 'attribute', null, [])->render('view')->toHtml()->render());
    }

    public function test_rendering_a_field_with_invalid_render_method()
    {
        $this->setupTextAndPasswordFieldTypes();

        $this->setExpectedException(Exception::class, 'Render method `foobar` for Text Field does not exist.');
        $this->fieldManager->create('text', 'attribute', null, [])->render('foobar');
    }

    public function test_field_type_does_not_exist()
    {
        $this->setupNoFieldTypes();

        $this->assertFalse($this->fieldManager->typeExists('text'));
        $this->assertFalse($this->fieldManager->typeExists('password'));
    }

    public function test_field_type_exists()
    {
        $this->setupTextAndPasswordFieldTypes();

        $this->assertTrue($this->fieldManager->typeExists(TextField::class));
        $this->assertTrue($this->fieldManager->typeExists('text'));
        $this->assertTrue($this->fieldManager->typeExists('password'));
    }

    public function test_retrieving_all_available_field_types_returns_none_when_empty()
    {
        // Empty field config should return empty array
        $this->setupNoFieldTypes();
        $types = $this->fieldManager->availableTypes();
        $this->assertTrue(is_array($types));
        $this->assertEmpty($types);
    }

    public function test_retrieving_all_available_field_types_returns_types_when_available()
    {
        // Defined field config should return array of field types
        $this->setupTextAndPasswordFieldTypes();
        $types = $this->fieldManager->availableTypes();
        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertArrayHasKey('password', $types);
        $this->assertArrayHasKey('text', $types);
        $this->assertContains(\LaravelFlare\Fields\Types\PasswordField::class, $types);
        $this->assertContains(\LaravelFlare\Fields\Types\TextField::class, $types);
    }
}
