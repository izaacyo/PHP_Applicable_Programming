<?php


class Page extends Entity {

    public function __construct($dbc){

         parent::__construct($dbc, 'pages');


    }

    protected function initFields()
    {
        // TODO: Implement initFields() method.
        $this->fields = [
            'id',
            'title',
            'content'

        ];
    }

}