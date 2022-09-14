<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Grammar\Plural
 * - Autoload, application dependencies
 */
namespace Sammy\Packs\Grammar\Plural {

    if (!class_exists('Sammy\\Packs\\Grammar\\Plural\\Base')){
    /**
     * @module singular
     * -
     * Used to convert plurar
     * in singular case
     */
    class Base {
        function parse ($str = null) {
            if (!is_string($str) && $str) {
                return;
            }

            $str = trim (
                $str
            );

            $particalCase = $this->particalCase(
                $str
            );
            if ($particalCase)
                return ($particalCase);

             if (preg_match('/(sis)$/i', $str)) {
                return preg_replace ('/(sis)$/i', 'ses',
                    $str
                );
            } elseif (preg_match ('/((s|c)h|x|s{1,}|z|o)$/i', $str)) {
                return (
                    $str . 'es'
                );
            } elseif (preg_match ('/([bcdefghijklmnpqrstwxyz]y)$/i', $str)) {
                return preg_replace ('/(y)$/i', 'ies',
                    $str
                );
            } elseif (preg_match('/(ouse)$/i', $str)) {
                return preg_replace ('/(ouse)$/i', 'ice',
                    $str
                );
            } elseif (preg_match('/(f(e|))$/i', $str)) {
                return preg_replace ('/(f(e|))$/i', 'ves',
                    $str
                );
            }

            return $str . 's';
        }

        private function particalCase ($str) {
            $pc = \php\requires ('./particalCases');
            if (is_array($pc)) {
                if (isset($pc[ \lower($str) ])) {
                    return (
                        $pc [
                            \lower($str)
                        ]
                    );
                }
            }
        }

    }}

    # ...
    $module->exports = (
        new Base
    );
}
