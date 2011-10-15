<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    Plugin
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Layout chooser
 *
 * @package    Plugin
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Plugin_Layout extends Zend_Controller_Plugin_Abstract
{

    /**
     * @var Zend_Layout
     */
    private $layout;

    /**
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (!$request instanceof Zend_Controller_Request_Http) {
            return false;
        }
        if (null === ($layout = $this->getLayout())) {
            return false;
        }

        /*@var $request Zend_Controller_Request_Http */
        $requestUri = $request->getRequestUri();
        if (preg_match('/[\.part|\.async]$/i', $requestUri)) {
            $layout->disableLayout();
            return true;
        }

        return false;
    }

	/**
     * @return the $layout
     */
    public function getLayout()
    {
        //@codeCoverageIgnoreStart
        if (null === $this->layout) {
            $this->layout = Zend_Layout::getMvcInstance();
        }
        //@codeCoverageIgnoreEnd
        return $this->layout;
    }

	/**
     * @param Zend_Layout $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

}