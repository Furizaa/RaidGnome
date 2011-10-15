<?php
/**
 * App
 *
 * @category   App
 * @package    Controller
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Password Recovery Action Helper
 *
 * @package    Controller
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class App_Controller_Helper_Recovery extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Generate Random 8digit Password using email as a seed
     *
     * @param string $email
     * @return string
     */
    public function generatePassword($email)
    {
        mt_srand(strlen($email));
        $result = '';
        for ($i = 0; $i < 8; $i++) {
            $charIndex = mt_rand(65, 90);
            $chr = chr($charIndex);
            $chr = mt_rand(0, 1) == 1 ? $chr : strtolower($chr);
            $result .= $chr;
        }
        return $result;
    }

}