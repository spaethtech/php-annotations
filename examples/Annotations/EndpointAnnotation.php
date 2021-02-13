<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace MVQN\Annotations;

use Exception;
use MVQN\Common\Arrays;
use MVQN\Common\Patterns;

final class EndpointAnnotation extends Annotation
{
    /** @const int Denotes supported annotation targets, defaults to ANY when not explicitly provided! */
    public const SUPPORTED_TARGETS = Annotation::TARGET_CLASS;

    /**
     * @param array $existing
     * @return array
     * @throws Exception
     */
    public function parse(array $existing = []): array
    {
        // DO Any validation or coercion here!!!

        if(Patterns::isJSON($this->value) || Patterns::isArray($this->value))
        {
            return Arrays::combineResults($existing, "endpoint", $this->value, Arrays::COMBINE_MODE_MERGE);
        }
        else
        {
            // ?
            return [];
        }
    }
}