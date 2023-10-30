<?php
// Include file that contains the code to be tested
require_once './_login.php';
use PHPUnit\Framework\TestCase;
class UmkmLoginTest extends TestCase
{
    public function testLoginWithEmptyUsername()
    {
        $_POST['useradmin'] = '';
        $_POST['passwordadmin'] = 'password_valid';
        $_POST['frm_ip'] = '192.168.1.1';
        $_POST['frm_device'] = 'Desktop';

        ob_start();
        login(); // Call the login function from your_script.php
        $output = ob_get_clean();

        $this->assertContains('Location:index.php', $output);
        $this->assertContains('Username required!', $output);
    }

    public function testLoginWithEmptyPassword()
    {
        $_POST['useradmin'] = 'admin1';
        $_POST['passwordadmin'] = '';
        $_POST['frm_ip'] = '192.168.1.1';
        $_POST['frm_device'] = 'Desktop';

        ob_start();
        login(); // Call the login function from your_script.php
        $output = ob_get_clean();

        $this->assertContains('Location:index.php', $output);
        $this->assertContains('Password required!', $output);
    }

    public function testLoginWithInvalidUsername()
    {
        $_POST['useradmin'] = 'username_salah';
        $_POST['passwordadmin'] = 'password_valid';
        $_POST['frm_ip'] = '192.168.1.1';
        $_POST['frm_device'] = 'Desktop';

        ob_start();
        login(); // Call the login function from your_script.php
        $output = ob_get_clean();

        $this->assertContains('Location:index.php', $output);
        $this->assertContains('Wrong username!', $output);
    }

    public function testLoginWithInvalidPassword()
    {
        $_POST['useradmin'] = 'admin1';
        $_POST['passwordadmin'] = 'password_salah';
        $_POST['frm_ip'] = '192.168.1.1';
        $_POST['frm_device'] = 'Desktop';

        ob_start();
        login(); // Call the login function from your_script.php
        $output = ob_get_clean();

        $this->assertContains('Location:index.php', $output);
        $this->assertContains('Wrong password!', $output);
    }

    // Add more test cases as needed
}
