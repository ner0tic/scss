<?php

/**
 * sfDebugTools provides some additionnals methods to help debugging a symfony
 * application.
 *
 * @package    sfToolsPlugin
 * @subpackage debug
 * @author     COil
 * @since      V1.0.0 - 21 oct 11
 */
class sfDebugTools
{
  /**
   * Dumps an array or object. Display, die or return the result. Note that Doctrine
   * objects are automaticaly detected and escaped as arrays of values.
   *
   * @param $var            mixed   Variable to dump
   * @param $name           String  Name of the var to dump
   * @param $die            boolean Tells the function to stop the process or not
   * @param $return_buffer  boolean Tells the function to return the dump
   */
  public static function dump($var, $name = 'var', $die = false, $return_buffer = false)
  {
    ob_start();
    print('<br/><pre>'. $name . (is_object($var) ? ' ('. get_class($var). ')' : ''). ' :'. PHP_EOL);
    print_r($var instanceof sfDoctrineRecord || $var instanceof Doctrine_Collection ? $var->toArray(true) : $var);
    print('</pre>');
    $buffer = ob_get_contents();
    ob_end_clean();

    $backtrace = debug_backtrace();
    $dieMsg = '<pre>';
    if ($die)
    {
      $dieMsg .= '<b>Process stopped by sfDebugTools:dump()</b>'. PHP_EOL;
    }
    $dieMsg .= isset($backtrace[0]['file']) ?     '&raquo; file     : <b>'.
      $backtrace[0]['file'] .'</b>'. PHP_EOL : '';
    $dieMsg .= isset($backtrace[0]['line']) ?     '&raquo; line     : <b>'.
      $backtrace[0]['line'] .'</b>'. PHP_EOL : '';
    $dieMsg .= isset($backtrace[1]['class']) ?    '&raquo; class    : <b>'.
      $backtrace[1]['class'] .'</b>'. PHP_EOL : '';
    $dieMsg .= isset($backtrace[1]['function']) ? '&raquo; function : <b>'.
      $backtrace[1]['function'] .'</b>'. PHP_EOL : '';
    $dieMsg .= '</pre>';

    if($return_buffer)
    {
      return $buffer;
    }
    else
    {
      print($buffer);
    }

    if ($die == true)
    {
      die($dieMsg);
    }
    else
    {
      print($dieMsg);
    }
  }

  /**
   * Same function as dump() but more suitable and readable for a console debug.
   *
   * @see self::dump()
   */
  public static function dump2($var, $name = 'var', $die = false, $return_buffer = false)
  {
    ob_start();
    print($name . ' : >');
    print_r($var instanceof sfDoctrineRecord || $var instanceof Doctrine_Collection ? $var->toArray(true) : $var);
    print('<'. PHP_EOL);
    $buffer = ob_get_contents();
    ob_end_clean();

    if($return_buffer)
    {
      return $buffer;
    }

    if ($die == true)
    {
      die($buffer);
    }
    else
    {
      print($buffer);
    }
  }

  /**
   * Alias for getMicroTime(microtime()).
   *
   * @see getMicroTime()
   * @since V1.0.0 - 19 oct 2011
   */
  public static function getMicroTimeNow()
  {
    return self::getMicroTime(microtime());
  }

  /**
   * Return microtime from a timestamp.
   *
   * @since V1.0.0 - 14 oct 2011
   * @param $time    Timestamp to retrieve micro time
   * @return numeric  Microtime of timestamp param
   */
  public static function getMicroTime($time)
  {
    list($usec, $sec) = explode(' ', $time);

    return (float)$usec + (float)$sec;
  }

  /**
   * Get the elapsed time between 2 time references.
   *
   * @since V1.0.0 - 19 oct 2011
   * @see getMicroTime()
   * @param   float $timeStart    Start time
   * @param   float $timeEnd      End time
   * @return  float               Numeric difference between the two times
   *                              ref in format 00.0000 sec
   */
  public static function getElapsedTime($timeStart, $timeEnd)
  {
    return round($timeEnd - $timeStart, 4);
  }
}