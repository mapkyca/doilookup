<?php

use Mapkyca\DOILookup\DOILookup;

class DOILookupTest extends \PHPUnit\Framework\TestCase {
  
  function doiProvider() {
    
    return [
        
        'zenodo' => [
            '10.5281/ZENODO.4277945',
        ],
        'zenodo-fullurl' => [
          'https://doi.org/10.5281/ZENODO.4277945',
        ]
        
    ];
    
  }
  
  
  /**
   * @dataProvider doiProvider
   */
  function testLookup($doi) {
    
    $lookup = new DOILookup($doi);

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