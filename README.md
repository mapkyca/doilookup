# DOI Lookup Tool

DOI Lookup tool - resolve DOIs to basic metadata using doi.org

## Usage

Create a new object for your doi, e.g.

```
$lookup = new DOILookup($doi);

$details = $lookup->getRawResult();
    
```

