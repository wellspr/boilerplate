<?php

namespace Mongo;

class Collection extends DB
{

    // Instantiate Collection
    public function getCollection(string $collectionName=null)
    {
        // var_dump($collectionName);
        $client = $this->client();

        $data = Access :: clusterAccessData();
        $dbName = $data['databaseName'];

        if($collectionName!=null){

            $collection = $client->$dbName->$collectionName;

        } else {

            $collection = $client->$dbName;

        }

        return $collection;
    }

}
