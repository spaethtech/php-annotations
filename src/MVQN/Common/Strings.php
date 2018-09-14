<?php
declare(strict_types=1);

namespace MVQN\Common;

final class Strings
{
    /**
     * @param string $haystack The 'haystack' for which to check occurrences of the 'needle'.
     * @param string $needle The 'needle' for which to search the 'haystack'.
     * @return bool Returns TRUE if the 'haystack' contains one or more occurrences of the 'needle', otherwise FALSE.
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return (strpos($haystack, $needle) !== false);
    }

    /**
     * @param string $haystack The 'haystack' for which to examine the first character.
     * @return bool Returns TRUE if the 'haystack' starts with an uppercase letter, otherwise FALSE.
     */
    public static function startsWithUpper(string $haystack): bool
    {
        return (preg_match('/[A-Z]$/',$haystack{0}) == true);
    }

    /**
     * @param string $haystack The 'haystack' for which to examine the beginning character(s).
     * @param string $needle The 'needle' for which to search the 'haystack'.
     * @return bool Returns TRUE if the 'haystack' begins with the 'needle', otherwise FALSE.
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @param string $haystack The 'haystack' for which to examine the ending character(s).
     * @param string $needle The 'needle' for which to search the 'haystack'.
     * @return bool Returns TRUE if the 'haystack' ends with the 'needle', otherwise FALSE.
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);
        return $length == 0 ? true : (substr($haystack, -$length) === $needle);
    }

}