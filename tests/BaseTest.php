<?php

use Mockery as m;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use LaravelFlare\Fields\FieldManager;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected $flare;

    protected $fieldManager;

    protected function setupField($name, $class)
    {
        $this->fieldManager = new FieldManager($this->flare);

        $this->flare->shouldReceive('config')
                    ->with('fields.types')
                    ->andReturn([$name => $class]);
    }

    protected function setupNoFieldTypes()
    {
        $this->fieldManager = new FieldManager($this->flare);

        // Empty field config should return empty array
        $this->flare->shouldReceive('config')
                    ->with('fields.types')
                    ->andReturn([]);
    }

    protected function setupTextAndPasswordFieldTypes()
    {
        $this->fieldManager = new FieldManager($this->flare);

        $this->flare->shouldReceive('config')
                    ->with('fields.types')
                    ->andReturn([
                        'password' => \LaravelFlare\Fields\Types\PasswordField::class,
                        'text' => \LaravelFlare\Fields\Types\TextField::class,
                    ]);
    }

    protected function setErrors($key, $messages)
    {
        $messageBag = new MessageBag([$key => $messages]);

        app(ViewFactory::class)->share('errors', (new ViewErrorBag)->put('default', $messageBag));
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
