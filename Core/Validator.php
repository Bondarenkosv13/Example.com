<?php
namespace Core;

abstract class Validator
{
    protected $errors = [];

    protected $rules = [];


    public function getErrors()
    {
        return $this->errors;
    }

    abstract public function storeValidation ($fields);
}