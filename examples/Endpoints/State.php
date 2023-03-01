<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace Examples\Endpoints;

/**
 * Class State
 *
 * @Endpoint { "getById": "/countries/states/:id" }
 *
 * @method int|null getCountryId()
 * @method string|null getName()
 * @method string|null getCode()
 *
 * @package SpaethTech\Annotations
 * @author Ryan Spaeth <rspaeth@spaethtech.com>
 * @copyright 2020 - Spaeth Technologies Inc.
 * @final
 */
final class State
{
    /**
     * @var int
     */
    protected int $countryId;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $code;

}
