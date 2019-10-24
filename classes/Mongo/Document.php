<?php

// CRUD Operations for User data

namespace Mongo;

class Document extends Collection
{

    public function setCollectionName($collectionName)
    {

        $this->collectionName = $collectionName;

    }

    public function getCollectionName()
    {

        return $this->collectionName;

    }


    // Create User (C)
    public function create($document, bool $many=false)
    {
        $collection = $this->getCollection($this->getCollectionName());

        if ($many===false) {

            $insertResult = $collection->insertOne($document);

        } else {

            $insertResult = $collection->insertMany($document);

        }

        return printf("Created %d document(s)\n", $insertResult->getInsertedCount());

    }


    // Read User (R)
    public function readOne($query)
    {
        $collection = $this->getCollection($this->getCollectionName());

        if (count($query)>0) {

            $element = $collection->findOne($query);

            if($element!=null){

                return $element;

            } else {

                echo "The query returned no results. <br>";

            }

        } else {

            return "Please inform some conditions to this query. <br>";

        }

    }

    public function readMany($queryList)
    {
        $elements = [];

        $collection = $this->getCollection($this->getCollectionName());

        foreach ($queryList as $query) {

            $element = $collection->find($query);

            if ($element) {

                foreach ($element as $item) {
                    array_push($elements, $item);
                }

            }

        }

        return $elements;
    }

    public function read($filter=[], array $options=[])
    {
        $collection = $this->getCollection($this->getCollectionName());

        $element = $collection->find($filter, $options);

        return $element;
    }


    // Update User(U)
    public function update($filter, $options, $many=false)
    {
        $collection = $this->getCollection($this->getCollectionName());

        if ($many!=false) {

            $updateResult = $collection->updateOne($filter, $options);

        } else {

            $updateResult = $collection->updateMany($filter, $options);

        }

        printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
        printf("Modified %d document(s)\n", $updateResult->getModifiedCount());
    }


    // Delete User(D)
    public function delete($query, $many=false)
    {
        $collection = $this->getCollection($this->getCollectionName());

        if ($many!=false) {

            $deleteResult = $collection->deleteOne($query);

        } else {

            $deleteResult = $collection->deleteMany($query);

        }

        printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());
    }

}
