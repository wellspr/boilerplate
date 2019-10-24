<?php

namespace Mongo;

class User extends Document
{

    public function define()
    {

        $this->setCollectionName("users");

    }


    public function exists(string $usernameInformed):bool
    {

        $filter = [];

        $options = [];

        $results = $this->read($filter, $options);

        $users = [];

        foreach ($results as $row) {

            foreach ($row as $value) {

                array_push($users, $value);

            }

        }

        return array_search($usernameInformed, $users, true);

    }


    public function passwordsMatch(string $usernameInformed, $passwordInformed):bool
    {

        $filter = ['username' => $usernameInformed];

        $options = [];

        $result = $this->read($filter, $options);

        foreach ($result as $row) {

            $passwordServer = $row->account->password;

            if ($passwordInformed===$passwordServer) {

                return true;

            } else {

                return false;

            }

        }

    }


    public function hasGoogleID(string $googleID)
    {

        $filter = ['googleID' => $googleID];

        $options = [];

        $results = $this->read($filter, $options);

        foreach ($results as $row) {

            if (isset($row->googleID)) {
                return true;
            }

        }

    }


}
