<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please read:
 *
 * Copyright (c) 2004-present Fabien Potencier

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 */

/**
 * Parser and formatter for date formats.
 *
 * @author Igor Wiedler <igor@wiedler.ch>
 *
 * @internal
 */
abstract class Transformer {

    /**
     * Format a value using a configured DateTime as date/time source.
     *
     * @param \DateTime $dateTime A DateTime object to be used to generate the formatted value
     * @param int       $length   The formatted value string length
     *
     * @return string The formatted value
     */
    abstract public function format(DateTime $dateTime, int $length): string;

    /**
     * Returns a reverse matching regular expression of a string generated by format().
     *
     * @param int $length The length of the value to be reverse matched
     *
     * @return string The reverse matching regular expression
     */
    abstract public function getReverseMatchingRegExp(int $length): string;

    /**
     * Extract date options from a matched value returned by the processing of the reverse matching
     * regular expression.
     *
     * @param string $matched The matched value
     * @param int    $length  The length of the Transformer pattern string
     *
     * @return array An associative array
     */
    public function extractDateOptions(string $matched, int $length): array {
        return [];
    }

    /**
     * Pad a string with zeros to the left.
     *
     * @param string $value  The string to be padded
     * @param int    $length The length to pad
     *
     * @return string The padded string
     */
    protected function padLeft(string $value, int $length): string {
        return str_pad($value, $length, '0', \STR_PAD_LEFT);
    }
}