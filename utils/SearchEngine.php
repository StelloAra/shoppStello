<?php

require_once("vendor/autoload.php");
require_once("Models/Product.php");

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

require_once("Models/Database.php");
$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();

class SearchEngine
{
    private $accessKey = 'PS_wztmxzwRLI5D-IA5HqA';
    private $secretKey = 'S__ZDTPxz5fy5eWcoUUoZiK0YzLUnw';
    private $url = "https://betasearch.systementor.se";
    private $index_name = "products-23";

    private  $client;

    function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->url,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->accessKey . ':' . $this->secretKey),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    function getDocumentIdOrUndefined(string $webId): ?string
    {
        $query = [
            'query' => [
                'term' => [
                    'webid' => $webId
                ]
            ]
        ];


        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            return $data['hits']['hits'][0]['_id'];
        } catch (RequestException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    function search(string $query, string $sortCol, string $sortOrder, int $pageNo, int $pageSize)
    {

        $aa = $query . '*';

        $query = [
            'query' => [
                'query_string' => [
                    'query' => $aa,
                ]
            ],
            'from' => ($pageNo - 1) * $pageSize,
            'size' => $pageSize,
            'sort' => [
                $sortCol => [
                    'order' => $sortOrder
                ]
            ],
            'aggs' => [
                'facets' => [
                    'nested' => [
                        'path' => 'string_facet',

                    ],
                    'aggs' => [
                        'names' => [
                            'terms' => [
                                'field' => 'string_facet.facet_name',
                                'size' => 10
                            ],
                            'aggs' => [
                                'values' => [
                                    'terms' => [
                                        'field' => 'string_facet.facet_value',
                                        'size' => 10
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return [
                    "message" => "Product eller categori SAKNAS",
                    "data" => [],
                    "num_pages" => 0,
                    "aggregations" => []
                ];
            }

            $data["hits"]["hits"] = $this->convertSearchEngineArrayToProduct($data["hits"]["hits"]);
            $pages = ceil($data["hits"]["total"]["value"] / $pageSize);

            return  [
                "data" => $data["hits"]["hits"],
                "num_pages" => $pages,
                "aggregations" => $data["aggregations"]["facets"]['names']['buckets']
            ];
        } catch (RequestException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    function convertSearchEngineArrayToProduct($searchengineResults)
    {
        $newarray = [];
        foreach ($searchengineResults as $hit) {
            $prod = new Product();
            $prod->id = $hit["_source"]["webid"];
            $prod->title = $hit["_source"]["title"];
            $prod->price = $hit["_source"]["price"];
            $prod->categoryName = $hit["_source"]["categoryName"];
            $prod->stockLevel = $hit["_source"]["stockLevel"];
            array_push($newarray, $prod);
        }
        return $newarray;
    }
}
