<?php

namespace Mapkyca\DOILookup;

use GuzzleHttp\Client;

class DOILookup
{

    private $result = [];
    private $endpoint = 'https://doi.org/';

    public function __construct(string $doi)
    {
        $this->result = $this->lookup($doi);
    }

    protected function lookup(string $doi): ?array
    {
        $client = new Client();

        $headers = [
            "Accept" => "application/vnd.citationstyles.csl+json"
        ];

        $body = [];

        $response = $client->request('GET', $this->endpoint . $this->normaliseDOI($doi), [
            'headers' => $headers,
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function normaliseDOI(string $doi): string
    {
        return parse_url($doi, PHP_URL_PATH);
    }

    public function getRawResult() : array {
        return $this->result;
    }

    public function getType() : ?string {
        return $this->getRawResult()['type'];
    }

    public function getDOI() : ?string {
        return $this->getRawResult()['DOI'];
    }

    public function getAbstract() : ?string {
        return $this->getRawResult()['abstract'];
    }

    public function getCategories() : ?array {
        return $this->getRawResult()['categories'];
    }

    public function getTitle() : ?string {
        return $this->getRawResult()['title'];
    }

    public function getURL() : ?string {
        return $this->getRawResult()['URL'];
    }

    public function getPublisher() : ?string {
        return $this->getRawResult()['publisher'];
    }

    public function getPublishedTime() : ?int {

        foreach (['created', 'issued'] as $time) {
            if (isset($this->result[$time])) { 
                return strtotime(implode('/', $this->result[$time]['date-parts'][0]));
            }
        }

        return null;
    }

    public function getAuthors() : ?array {
        $authors = []; 
        $a = $this->getRawResult()['author'];

        foreach ($a as $author) {
            $authors[] = $author['given'] . ' ' . $author['family'];
        }

        return $authors;
    }

}
