<?php


class User extends Entity {

    public function __construct($dbc){

        parent::__construct($dbc, 'users');

    }

    protected function initFields()
    {
        // TODO: Implement initFields() method.

        $this->fields = [
            'id',
            'name',
            'username',
            'password',
            'password_hash'

        ];
    }


}