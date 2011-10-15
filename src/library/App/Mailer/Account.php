<?php
/**
 * App
 *
 * @category   App
 * @package    Mailer
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Account Mailer
 *
 * @package    Mailer
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class App_Mailer_Account
{

    /**
     * @var Gnome_Model_Account
     */
    private $account;

    /**
     * @var Zend_Mail_Transport_Abstract
     */
    private $transport;

    /**
     * @var Zend_View
     */
    private $view;

    /**
     * @param Gnome_Model_Account $account
     * @throws InvalidArgumentException
     */
    public function __construct(Gnome_Model_Account $account)
    {
        if (null === $account->getEmail()) {
            throw new InvalidArgumentException('Account has no mail address!');
        }
        $this->account = $account;
    }

    /**
     * @return Zend_Mail_Transport_Abstract
     */
    public function getTransport()
    {
        if (null === $this->transport) {
            $this->transport = Zend_Mail::getDefaultTransport();
        }
        return $this->transport;
    }

    /**
     * @param Zend_Mail_Transport_Abstract $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

	/**
     * @return Zend_View_Abstract $view
     */
    public function getView()
    {
        //@coverageIgnoreStart
        if (null === $this->view) {
            $this->view = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->view;
        }
        //@coverageIgnoreEnd
        return $this->view;
    }

	/**
     * @param Zend_View_Abstract $view
     */
    public function setView(Zend_View_Abstract $view)
    {
        $this->view = $view;
    }

    /**
     * Send Account Verification Email
     */
    public function sendAccountVerificationMail()
    {
        if (null === $this->account->getUniqueKey()) {
            throw new InvalidArgumentException('Account has no unique key.');
        }

        $htmlMail = $this->getView()->partial(
            'mail-templates/verification-html.phtml',
            array('account' => $this->account)
        );
        $textMail = $this->getView()->partial(
            'mail-templates/verification-text.phtml',
            array('account' => $this->account)
        );

        $mail = new Zend_Mail();
        $mail->addTo($this->account->getEmail());
        $mail->setBodyHtml($htmlMail, 'UTF-8', Zend_Mime::ENCODING_8BIT);
        $mail->setBodyText($textMail, 'UTF-8', Zend_Mime::ENCODING_8BIT);

        $this->getTransport()->send($mail);
    }

    /**
     * Send Mail to verify Email for Password recovery
     */
    public function sendPasswordRecoveryMail()
    {
        if (null === $this->account->getUniqueKey()) {
            throw new InvalidArgumentException('Account has no unique key.');
        }

        $textMail = $this->getView()->partial(
            'mail-templates/recovery-text.phtml',
            array('account' => $this->account)
        );

        $mail = new Zend_Mail();
        $mail->addTo($this->account->getEmail());
        $mail->setBodyText($textMail, 'UTF-8', Zend_Mime::ENCODING_8BIT);

        $this->getTransport()->send($mail);
    }

	/**
     * Send Mail to verify Email for Password recovery
     *
     * @param String $password
     */
    public function sendNewPasswordMail($password)
    {
        if (null === $this->account->getUniqueKey()) {
            throw new InvalidArgumentException('Account has no unique key.');
        }

        $textMail = $this->getView()->partial(
            'mail-templates/password-text.phtml',
            array('account' => $this->account, 'password' => $password)
        );

        $mail = new Zend_Mail();
        $mail->addTo($this->account->getEmail());
        $mail->setBodyText($textMail, 'UTF-8', Zend_Mime::ENCODING_8BIT);

        $this->getTransport()->send($mail);
    }

}