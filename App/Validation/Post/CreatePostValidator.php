<?php
namespace App\Validation\Post;

use Core\Validator;

class CreatePostValidator extends Validator
{
    protected $errors = [
        'title_error'   => 'The title should contain more than 5 letters!',
        'content_error' => 'The should not be empty!'
    ];

    protected $rules = [
        'title'     => '/[a-zа-я0-9,.!?#$%^:;\'+=-_)(*& ]{5,}/i',
        'content'   => '/[a-zа-я0-9,.!?#$%^:;\'+=-_)(*& ]{1,}/i'
    ];

    public function pullVariableValidation($params)
    {
        foreach ($params as $key => $value)
        {
            $fields[$key] = trim($value);
            if($fields[$key] == null){
                $_SESSION['error'] = "Fill in all the fields";
                way('posts/create');
            }
        }
    }

    public function storeValidation($fields)
    {
        foreach ($fields as $key => $field)
        {
            $field = trim($field);
            if($fields[$key] == null)
            {
                $this->errors["{$key}_error"] = "Fill the field {$key}!";
            }
            elseif(preg_match($this->rules[$key], $field))
            {
                unset($this->errors["{$key}_error"]);
            }
        }
        return empty($this->errors);
    }

    public function imageValidation($files)
    {
        if($files['image']['error'] !== 0)
        {
            $_SESSION['error'] = 'The image must be added!';

            return true;
        }
        elseif(!preg_match('/(png|jpeg)/m', $files['image']['type']))
        {
            $_SESSION['error'] = 'The image must be jpeg or png format!';

            return true;
        }
    }
}