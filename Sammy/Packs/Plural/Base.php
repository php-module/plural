<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Plural
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs\Plural {
  /**
   * Make sure the module base internal trait is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!trait_exists ('Sammy\Packs\Plural\Base')) {
  /**
   * @trait Base
   * Base internal trait for the
   * Plural module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  trait Base {
    /**
     * @method string parse
     *
     * Parse a given string word to
     * plural.
     *
     * Firstly, verify if the string
     * is not in plural in order avoiding
     * to do a double convertion.
     */
    public function parse (string $string = null) {
      if (!(!empty ($string))) return '';

      $string = trim ($string);

      if ($particularCase = self::IsParticularCase ($string)) {
        return $particularCase;
      }

      if (preg_match ('/(sis)$/i', $string)) {
        return preg_replace ('/(sis)$/i', 'ses', $string);
      } elseif (preg_match ('/((s|c)h|x|s{1,}|z|o)$/i', $string)) {
        return $string . 'es';
      } elseif (preg_match ('/([bcdefghijklmnpqrstwxyz]y)$/i', $string)) {
        return preg_replace ('/(y)$/i', 'ies',$string);
      } elseif (preg_match('/(ouse)$/i', $string)) {
        return preg_replace ('/(ouse)$/i', 'ice', $string);
      } elseif (preg_match ('/(f(e|))$/i', $string)) {
        return preg_replace ('/(f(e|))$/i', 'ves', $string);
      }

      return $string . 's';
    }

    public function __invoke () {
      return call_user_func_array ([$this, 'parse'], func_get_args ());
    }
  }}
}
