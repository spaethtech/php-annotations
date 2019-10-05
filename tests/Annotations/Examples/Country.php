<?php
declare(strict_types=1);

namespace Tests\MVQN\Annotations\Examples;


use Tests\MVQN\Annotations\EndpointAnnotation;
use Tests\MVQN\Annotations\EndpointAnnotation as Endpoint;

/**
 * Class Country
 *
 * @package Tests\MVQN\Annotations\Examples
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 * @final
 *
 * @other-endpoints { "get": "/countries", "getById": "/countries/:id" }
 * @Endpoint [ "get" => "/countries" ]
 * @\Tests\MVQN\Annotations\EndpointAnnotation { "getById": "/countries/:id" }
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
    protected $name;

    /**
     * @var string|null The country's abbreviation.
     */
    protected $code;

    /**
     * @return string|null Returns the country's abbreviation.
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

}
