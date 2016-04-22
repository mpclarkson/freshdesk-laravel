<?php

namespace Mpclarkson\Laravel\Freshdesk\Test;

use Illuminate\Support\Facades\App;
use Mpclarkson\Laravel\Freshdesk\FreshdeskFacade as Freshdesk;
use Mpclarkson\Laravel\Freshdesk\FreshdeskServiceProvider;
use Illuminate\Container\Container;

abstract class FreshdeskServiceProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testServiceNameIsProvided()
    {
        $app = $this->setupApplication();
        $provider = $this->setupServiceProvider($app);
        $this->assertContains('freshdesk', $provider->provides());
    }

    public function testApiResourcesAreResolved()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);

        // Mount facades
        Freshdesk::setFacadeApplication($app);

        $this->assertInstanceOf('Freshdesk\Resources\Agent', Freshdesk::agents());
        $this->assertInstanceOf('Freshdesk\Resources\Contact', Freshdesk::contacts());
        $this->assertInstanceOf('Freshdesk\Resources\Company', Freshdesk::companies());
        $this->assertInstanceOf('Freshdesk\Resources\Group', Freshdesk::groups());
        $this->assertInstanceOf('Freshdesk\Resources\Ticket', Freshdesk::tickets());
        $this->assertInstanceOf('Freshdesk\Resources\TimeEntry', Freshdesk::timeEntries());
        $this->assertInstanceOf('Freshdesk\Resources\Conversation', Freshdesk::conversations());
        $this->assertInstanceOf('Freshdesk\Resources\Category', Freshdesk::categories());
        $this->assertInstanceOf('Freshdesk\Resources\Forum', Freshdesk::forums());
        $this->assertInstanceOf('Freshdesk\Resources\Topic', Freshdesk::topics());
        $this->assertInstanceOf('Freshdesk\Resources\Comment', Freshdesk::comments());
        $this->assertInstanceOf('Freshdesk\Resources\EmailConfig', Freshdesk::emailConfigs());
        $this->assertInstanceOf('Freshdesk\Resources\Product', Freshdesk::products());
        $this->assertInstanceOf('Freshdesk\Resources\BusinessHour', Freshdesk::businessHours());
        $this->assertInstanceOf('Freshdesk\Resources\SLAPolicy', Freshdesk::SLAPolicies());
    }



    /**
     * @return Container
     */
    abstract protected function setupApplication();

    /**
     * @param Container $app
     *
     * @return FreshdeskServiceProvider
     */
    private function setupServiceProvider(Container $app)
    {
        // Create and register the provider.
        $provider = new FreshdeskServiceProvider($app);
        $app->register($provider);
        $provider->boot();

        return $provider;
    }
}
