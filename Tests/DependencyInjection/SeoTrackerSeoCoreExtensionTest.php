<?php

/**
 * This file is part of the Seo Core Bundle
 *
 * Copyright (c) 2014 Mickaël Andrieu
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeoTracker\Bundle\SeoCoreBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use SeoTracker\Bundle\SeoCoreBundle\DependencyInjection\SeoTrackerSeoCoreExtension;

class SeoTrackerSeoCoreExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $containerBuilder;

    protected function setUp()
    {
        $this->containerBuilder = new ContainerBuilder();
    }

    protected function tearDown()
    {
        $this->containerBuilder = null;
    }

    public function testDefaultValues()
    {
        $loader = new SeoTrackerSeoCoreExtension();
        $loader->load(array(), $this->containerBuilder);

        $this->assertHasParameter('seo_tracker_seo_core.crawler');
        $this->assertHasParameter('seo_tracker_seo_core.scrapper');
        $this->assertHasParameter('seo_tracker_seo_core.search_engine');

        $this->assertParameterValue('seo_tracker_seo_core.crawler', '%seo_tracker_seo_core.sf_crawler.class%');
        $this->assertParameterValue('seo_tracker_seo_core.scrapper', '%seo_tracker_seo_core.curl_scrapper.class%');
        $this->assertParameterValue('seo_tracker_seo_core.search_engine', '%seo_tracker_seo_core.google_engine.class%');
    }

    private function assertHasParameter($id)
    {
        $this->assertTrue($this->containerBuilder->hasParameter($id));
    }

    private function assertParameterValue($key, $value)
    {
        $this->assertEquals($value, $this->containerBuilder->getParameter($key));
    }
}
