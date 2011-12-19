<?php

/**
 * sfFileTools provides some additionnal tools methods for file processing.
 *
 * @package    sfToolsPlugin
 * @subpackage debug
 * @author     COil
 * @since      V1.0.1 - 3 nov 2011
 */
class sfFileTools
{
  /**
   * Make a filename safe to use in the OS, command line. (Not a slug function)
   *
   * @author COil
   * @since  V1.0.1 - 3 nov 2011
   * @see    test/sfFileToolsTest.php
   * @see    http://stackoverflow.com/questions/2668854/sanitizing-strings-to-make-them-url-and-filename-safe
   */
  public static function sanitizeFilename($sFileName, $sSeparator = '_')
  {
    $sFileName  = trim($sFileName);
    $sFileInfos = pathinfo($sFileName);
    $sFileName  = $sFileInfos['filename'];
    $sExt       = isset($sFileInfos['extension']) ? '.'. strtolower($sFileInfos['extension']) : '';

    // Remove accents
    if (function_exists('iconv'))
    {
      $sFileName = iconv('UTF-8', 'us-ascii//TRANSLIT', strtolower($sFileName));
    }

    // Remove all characters that are not the separator, letters, numbers, dot or whitespace
    $sFileName = preg_replace("/[^ a-zA-Z\_\d\.]|\s/", '', $sFileName);

    // Replace all separator characters by a single separator
    $sFileName = preg_replace('!['. preg_quote($sSeparator).'\s]+!u', $sSeparator, $sFileName);

    return $sFileName. $sExt;
  }
}