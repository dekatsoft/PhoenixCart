<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class Date {

    protected $timestamp;

    /**
     * Construct a Date object.
     * Strings need to be in this format: YYYY-MM-DD HH:MM:SS
     * @param mixed $date
     */
    public function __construct($date) {
      if (is_int($date)) {
        $this->timestamp = $date;
      } elseif ( ($date === '0000-00-00 00:00:00') || !$date ) {
        $this->timestamp = false;
      } else {
        $this->timestamp = mktime(
          (int)substr($date, 11, 2),
          (int)substr($date, 14, 2),
          (int)substr($date, 17, 2),
          (int)substr($date, 5, 2),
          (int)substr($date, 8, 2),
          (int)substr($date, 0, 4));
      }
    }

    /**
     * Format this date with IntlDateFormatter.
     * @param string $format An IntlDateFormatter format string.
     * @return mixed
     */
    public function format($format) {
      return $this->timestamp
           ? (new IntlDateFormatter('en', IntlDateFormatter::FULL, IntlDateFormatter::NONE, null, IntlDateFormatter::GREGORIAN, $format))->format($this->timestamp)
           : false;
    }

    /**
     * Return the timestamp.
     */
    public function get_timestamp() : int {
      return $this->timestamp;
    }

// Output in the selected locale date format, long version
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
    public static function expound($raw_date) {
      $timestamp = (new Date($raw_date))->get_timestamp();
      return $timestamp ? $GLOBALS['long_date_formatter']->format($timestamp) : false;
    }

////
// Output in the selected locale date format, shorter version
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
    public static function abridge($raw_date) {
      $timestamp = (new Date($raw_date))->get_timestamp();
      return $timestamp ? $GLOBALS['short_date_formatter']->format($timestamp) : false;
    }

    /**
     * Create with the current date.
     * @return Date
     */
    public static function now() {
      return new Date(time());
    }

  }
