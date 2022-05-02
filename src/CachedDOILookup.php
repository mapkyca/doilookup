<?php

namespace Mapkyca\DOILookup;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CachedDOILookup extends DOILookup
{
    private $cache;
    
    public function __construct(AdapterInterface $cache, string $doi)
    {
        $this->cache = $cache;
        parent::__construct($doi);
    }

    protected function lookup(string $doi): ?array
    {
        $doi = $this->normaliseDOI($doi);
        $key = 'doi-' . sha1($doi);

        return $this->cache->get($key, function(ItemInterface $item) use ($doi) {

            return parent::lookup($doi);

        });

    }


}
