<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    View
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Mein Menu View Helper
 *
 * @package    View
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_View_Helper_MainMenu extends Zend_View_Helper_Navigation_Menu
{

    /**
     * CSS class to use for the ul element
     *
     * @var string
     */
    protected $_ulClass = '';

    /**
     * (non-PHPdoc)
     * @see Zend_View_Helper_Abstract::direct()
     */
    public function direct()
    {
        return $this;
    }

    /**
     * Render Main Menu
     */
    public function mainMenu()
    {
        $menuPages = new Zend_Navigation();
        $menuPages->addPage(array(
            'label' => 'Home',
            'controller' => 'index',
            'action' => 'index'
        ));
        $menuPages->addPage(array(
            'label' => 'SignUp',
            'class' => 'signup',
            'id' => 'signup',
            'controller' => 'account',
            'action' => 'signup'
        ));
        $menuPages->addPage(array(
            'label' => 'Login Account',
            'class' => 'login',
            'controller' => 'account',
            'action' => 'login'
        ));
        $menuPages->addPage(array(
            'label' => 'Blog',
            'controller' => 'blog',
            'action' => 'index',
            'active' => false
        ));

        return parent::menu($menuPages);
    }

}
