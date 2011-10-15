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
 * Test Case
 *
 * @package    Mailer
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class TestApp_Mailer_AccountTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->account = new Gnome_Model_Account();
        $this->account->setEmail('does.not.exists@wowgnome.com');
        $this->account->setUniqueKey('ABC123');

        $this->transport = $this->getMock('Zend_Mail_Transport_Sendmail', array(), array(), '', false);

        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
        $this->dispatch('/');
    }

    public function testSendAccountVerification()
    {
        $this->transport
            ->expects($this->once())
            ->method('send')
            ->will($this->returnCallback(array($this, 'sendAccountVerificationCallback')));

        $mailer = new App_Mailer_Account($this->account);
        $mailer->setTransport($this->transport);
        $mailer->sendAccountVerificationMail();
    }

    public function sendAccountVerificationCallback(Zend_Mail $mail)
    {
        $this->assertRegExp('/ABC123/', $mail->getBodyHtml()->getRawContent());
        $this->assertRegExp('/ABC123/', $mail->getBodyText()->getRawContent());
    }

    public function testSendRecoveryVerification()
    {
        $this->account->setUniqueKey('123ABC');

        $this->transport
            ->expects($this->once())
            ->method('send')
            ->will($this->returnCallback(array($this, 'sendRecoveryVerificationCallback')));

        $mailer = new App_Mailer_Account($this->account);
        $mailer->setTransport($this->transport);
        $mailer->sendPasswordRecoveryMail();
    }

    public function sendRecoveryVerificationCallback(Zend_Mail $mail)
    {
        $this->assertRegExp('/123ABC/', $mail->getBodyText()->getRawContent());
    }

    public function testSendPasswordMail()
    {
        $this->transport
            ->expects($this->once())
            ->method('send')
            ->will($this->returnCallback(array($this, 'sendPasswordCallback')));

        $mailer = new App_Mailer_Account($this->account);
        $mailer->setTransport($this->transport);
        $mailer->sendNewPasswordMail('a1b2c3');
    }

    public function sendPasswordCallback(Zend_Mail $mail)
    {
        $this->assertRegExp('/a1b2c3/', $mail->getBodyText()->getRawContent());
    }

}