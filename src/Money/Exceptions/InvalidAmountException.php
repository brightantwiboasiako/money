<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 12/14/2015
 * Time: 10:05 PM
 */

namespace Money\Exceptions;


class InvalidAmountException extends \Exception
{

    public function __construct()
    {
        parent::__construct("Invalid amount encountered!", 0);
    }

}