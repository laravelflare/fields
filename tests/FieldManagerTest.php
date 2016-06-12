<?php

use Mockery as m;
use LaravelFlare\Fields\FieldManager;

class FieldManagerTest extends \PHPUnit_Framework_TestCase
{
    public static $functions;

    private $flare;

    private $fieldManager;

    public function setUp()
    {
        parent::setUp();

        self::$functions = m::mock();
        $this->flare = m::mock(\LaravelFlare\Flare\Flare::class);
    }

    public function test_creating_a_new_field()
    {
        $this->markTestIncomplete('test_creating_a_new_field');
    }

    public function test_creating_a_field_that_does_not_exist()
    {
        $this->markTestIncomplete('test_creating_a_field_that_does_not_exist');
        
    }

    public function test_rendering_a_new_field()
    {
        $this->markTestIncomplete('test_rendering_a_new_field');

    }

    public function test_rendering_a_field_that_does_not_exist()
    {
        $this->setupNoFieldTypes();

        $this->markTestIncomplete('test_rendering_a_field_that_does_not_exist');

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

    public function tearDown()
    {
        parent::tearDown();

        m::close();
    }
}
