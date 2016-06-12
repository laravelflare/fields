<?php

use Mockery as m;
use LaravelFlare\Fields\FieldManager;
use LaravelFlare\Fields\Types\BaseField;
use LaravelFlare\Fields\Types\TextField;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Contracts\View\Factory as ViewFactory;

/**
 * Tests the Field Manager Class and the generation
 * of Fields based on the BaseField class.
 */
class FieldManagerTest extends \Orchestra\Testbench\TestCase
{
    private $flare;

    private $fieldManager;

    public function test_creating_a_field_that_does_not_exist()
    {
        $this->setupNoFieldTypes();

        $this->fieldManager = new FieldManager($this->flare);
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

        $this->fieldManager = new FieldManager($this->flare);
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

        $this->fieldManager = new FieldManager($this->flare);

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

        $this->fieldManager = new FieldManager($this->flare);

        $this->assertContains('<label class="control-label" for="attribute">', $this->fieldManager->create('text', 'attribute', null, [])->render('add')->render());
        $this->assertContains('<label class="control-label" for="attribute">', $this->fieldManager->create('text', 'attribute', null, [])->render('edit')->render());
        $this->assertContains('<label class="control-label" for="attribute">', $this->fieldManager->create('text', 'attribute', null, [])->render('clone')->render());
        $this->assertContains('Attribute', $this->fieldManager->create('text', 'attribute', null, [])->render('view')->render());
    }

    public function test_rendering_a_field_with_invalid_render_method()
    {
        $this->setupTextAndPasswordFieldTypes();

        $this->fieldManager = new FieldManager($this->flare);

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

    private function setupNoFieldTypes()
    {
        $this->fieldManager = new FieldManager($this->flare);

        // Empty field config should return empty array
        $this->flare->shouldReceive('config')
                    ->with('fields.types')
                    ->andReturn([]);
    }

    private function setupTextAndPasswordFieldTypes()
    {
        $this->fieldManager = new FieldManager($this->flare);

        $this->flare->shouldReceive('config')
                    ->with('fields.types')
                    ->andReturn([
                        'password' => \LaravelFlare\Fields\Types\PasswordField::class,
                        'text' => \LaravelFlare\Fields\Types\TextField::class,
                    ]);
    }

    public function setUp()
    {
        parent::setUp();

        $this->app
            ->make(\Illuminate\Contracts\Http\Kernel::class)
            ->pushMiddleware(\Illuminate\Session\Middleware\StartSession::class);

        Request::setSession($this->app['session.store']);

        app(ViewFactory::class)->share('errors', Request::session()->get('errors') ?: new ViewErrorBag);

        $this->app['view']->addNamespace('flare', __DIR__.'/../src/resources/views');

        $this->flare = m::mock(\LaravelFlare\Flare\Flare::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
