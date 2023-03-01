<?php
/**
 * @noinspection PhpUnused
 * @noinspection PhpUnusedAliasInspection
 * @noinspection PhpUnusedParameterInspection
 */
declare(strict_types=1);

namespace Examples\Endpoints;

use Examples\Annotations\EndpointAnnotation;
use Examples\Annotations\EndpointAnnotation as Endpoint;

/**
 * Class Country
 *
 * @package SpaethTech\Annotations\Examples
 * @author Ryan Spaeth <rspaeth@spaethtech.com>
 * @copyright 2020 - Spaeth Technologies Inc.
 * @final
 *
 * @other-endpoints { "get": "/countries", "getById": "/countries/:id" }
 * @Endpoint [ "get" => "/countries" ]
 * @\Examples\Annotations\EndpointAnnotation { "getById": "/countries/:id" }
 * @EndpointAnnotation [ "post" => "/countries" ]
 *
 * @method string|null getName()
 *
 */
final class Country
{
    // =================================================================================================================
    // PROPERTIES
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @var string|null $name The country's name.
     */
    protected ?string $name;

    /**
     * @var string|null The country's abbreviation.
     */
    protected ?string $code;

    /**
     * @param string $test
     * @return string|null Returns the country's abbreviation.
     */
    public function getCode(string $test): ?string
    {
        return $this->code;
    }

}
