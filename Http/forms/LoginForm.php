<?php

namespace Http\forms;

use core\ValidationException;

class LoginForm
{

    protected $errors = [];

    public function __construct(public  array $attributes)
    {

        if (!\core\Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please enter a valid email';
        }

        if (!\core\Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);
        return $instance->failed() ? $instance->throw() : $instance;

    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);

    }

    public function failed()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}