<?php


namespace Mouf\Hydrator;


class MissingParameterException extends \BadMethodCallException
{
    public static function create(string $missingParameter)
    {
        return new self(sprintf('Unable to find require parameter %s', $missingParameter));
    }
}