<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace SpaethTech\Annotations\Standard;

use SpaethTech\Annotations\Annotation;

/**
 * Class VarAnnotation
 *
 * @package SpaethTech\Annotations\Standard
 *
 * @author Ryan Spaeth <rspaeth@spaethtech.com>
 * @copyright 2022 Spaeth Technologies Inc.
 *
 * @final
 */
final class VarAnnotation extends Annotation
{
    /** @const int Denotes supported annotation targets, defaults to ANY when not explicitly provided! */
    public const SUPPORTED_TARGETS = Annotation::TARGET_PROPERTY;

    /** @const bool Denotes supporting multiple declarations of this annotation per block, defaults to TRUE! */
    public const SUPPORTED_DUPLICATES = false;

    /**
     * @param array $existing Any existing annotations that were previously parsed from the same declaration.
     * @return array Returns an array of keyword => value(s) parsed by this Annotation implementation.
     */
    public function parse(array $existing = []): array
    {
        $pattern = '/^([\w|\[\]_\\\\]+)\s*(\$\w+)?(.*)?$/';

        if (preg_match($pattern, $this->value, $matches)) {
            $existing["var"]["types"] = explode("|", $matches[1]);
            $existing["var"]["name"] = $matches[2] ?: $this->name;
            $existing["var"]["description"] = $matches[3];
        }

        return $existing;
    }
}
