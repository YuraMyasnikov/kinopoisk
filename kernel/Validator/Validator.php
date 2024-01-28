<?php

namespace App\Kernel\Validator;

class Validator implements ValadatorInterface
{
    private array $errors = [];
    private array $data;

    public function validate(array $data, array $rules): bool  //(array ['name' => 'yura'], array [0=>'required'])
    {

        $this->errors = []; // обнуляю массив ошибок
        $this->data = $data; //array [names for input]


        foreach ($rules as $key => $rule) //$rules =  ['name' => [0 => 'required, 1 => 'min:3']]
        {
            $rules = $rule;

            foreach ($rules as $rule) // $rules = [0 => 'required, 1 => 'min:3']]
            {

                $rule = explode(':', $rule); //получаю значение каждого правила

                $ruleName = $rule[0]; //название (require, min,max....)
                $ruleValue = $rule[1] ?? null; //значение допустимости, (если не определено = null) - [null, 3,10]

                $error = $this->validateRules($key, $ruleName, $ruleValue); // ('name', required, null) далее следующие правила

                if($error)
                {
                    $this->errors[$key][] = $error;
                }
            }

        }
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    // key - поле (name_movie) ruleName - имя ограничения(min) ruleValue - значение ограничения (3 / null)
    private function validateRules(string $key,string $ruleName,string $ruleValue = null) : string|false //1 name_movie, require, null 2...
    {
        $value = $this->data[$key];  //value - название фильма . data - массив фильма  key - значение

        switch ($ruleName){ // проверка валидации
            case 'email':
                if ($value > strlen($value)){
                    if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        return "Поле $key со значением $value не является почтой";
                    }
                }break;
            case 'required':
                if(empty($value))
                {
                    return "Поле $key обязательно";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue)
                {
                    return "Поле $key должен содержать минимум $ruleValue символа";
                }
                break;
            case 'max':
                if(strlen($value) > $ruleValue)
                {
                    return "Сократи значение в поле $key. Вместительность - $ruleValue символов. У тебя ($value) ". strlen($value) . "символа ";
                }break;

        }
        return false;
    }
}