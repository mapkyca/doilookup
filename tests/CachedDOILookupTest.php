<?php

namespace Mapkyca\DOILookup\Tests;

use Mapkyca\DOILookup\CachedDOILookup;
use Mapkyca\DOILookup\Tests\DOILookupTest;

use Symfony\Component\Cache\Adapter\ArrayAdapter;

class CachedDOILookupTest extends DOILookupTest {
  
 
  /**
   * @dataProvider doiProvider
   */
  function testCachedLookup($doi) {
    
    $lookup = new CachedDOILookup( new ArrayAdapter(), $doi);

    $this->assertNotEmpty($lookup->getRawResult());
    
    $this->assertNotEmpty($lookup->getType());
    $this->assertNotEmpty($lookup->getDOI());
    $this->assertNotEmpty($lookup->getAbstract());
    $this->assertNotEmpty($lookup->getTitle());
    $this->assertNotEmpty($lookup->getAuthors());
    $this->assertNotEmpty($lookup->getPublishedTime());
    $this->assertNotEmpty($lookup->getURL());
    $this->assertNotEmpty($lookup->getPublisher());
  }
  
}