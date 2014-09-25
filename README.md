SeoCoreBundle
================

SeoCore bundle is an Symfony2 implementation of seotracker/seo-core library.
This is a common way to deal with websites, search engines and scrappers.


1) Websites
-----------

Website is an object representation of a real website.
A website **MUST** have a HTML content.

A website object can return useful data for SEO like:

* Website title
* Website metadata & rich contents
* Website keywords occurrences and proportions (Not implemented)
* Website location url

See ``WebsiteInterface`` of seo-core library for more information about it.

2) SearchEngines
----------------

SearchEngine is an object representation of a real search engine.
A search engine **SHOULD USE** a scrapper to get information from internet network.

A search engine can return useful datas for SEO like:

* All websites for a needle (aka a "keyword")
* Website position in the concerned search engine for a needle
* All backlinks for a website in this search engine

See ``SearchEngineInterface`` of seo-core for more information about it.

3) Scrappers
------------

A scrapper is an object used to get HTML from internet network.

As this object have only 1 job to do, the only method to implement is ``get``
which accept at least 1 argument: an url location.

See ``ScrapperInterface`` and implementations in ``Adapter\Scrapper`` folders of seo-core library.

4) Crawlers
-----------

A crawler is an object used to query and manipulate HTML DOM.

Seo-core offers an interface and his Symfony2-Component based implementation.

See ``CrawlerInterface`` and implementation in ``Adapter\Crawler`` folders of seo-core library.


5) Example
----------

```php
namespace SeoTracker\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/seo/{url}")
     * @Template()
     */
    public function indexAction($url)
    {
        $googleEngine = $this->get('seo_tracker.search_engine');
        $website = $googleEngine->getWebsite($url);

        // position of website in Google
        $position = $googleEngine->getPosition('seo tools online platform', $website); // 1

        // title of website
        $title = $website->getTitle(); // 'SeoTracker : A SEO tools suite'

        // metas of website
        $metas = $googleEngine->getMetas();
        // ['description' => 'Seo Tracker est une plateforme de suivi et d'optimisation [..]']

        // microdatas of website
        $microDatas = $googleEngine->getMicroDatas();
        /**
         * [0 =>
         *     'type' =>
         *         [0 => 'http://www.schema.org/CreativeWork']
         *     ,
         *     'properties' => [...]]
         * ],
         * [ 1 => [..] ]
         **/

        // backlinks of website location in search engine
        $backlinks = $googleEngine->getBacklinks($website);
        /**
         * [
         *     0 => 'http://seo-core.com',
         *     1 => 'http://otherwebsite.backlink'
         * ]
         **/

         return [];
    }
```
