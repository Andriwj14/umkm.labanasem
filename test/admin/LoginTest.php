<?php
use PHPUnit\Framework\TestCase;


class LoginTest extends TestCase

{
  public function testLoginWithInvalidUsername()
  {
      // Simulasikan input POST dengan username salah
      $_POST['username'] = 'username_salah';
      $_POST['password'] = 'admin';
    //   $_POST['frm_ip'] = '192.168.1.1';
    //   $_POST['frm_device'] = 'Desktop';

      // Panggil kode login
      ob_start();
      include "../../_admin/_login.php"; // Gantilah dengan jalur yang sesuai
      $output = ob_get_clean();
      echo($output);

      // Periksa apakah pengguna diarahkan kembali ke halaman index.php dengan pesan "Wrong username!"
      $this->assertEquals($output, http_response_code());
  }

  public function testLoginWithInvalidPassword()
    {
        // Simulasikan input POST dengan password salah
        $_POST['username'] = 'admin1';
        $_POST['password'] = '21232f297a57a5a743894a0e4a801fc3';
        // $_POST['frm_ip'] = '192.168.1.1';
        // $_POST['frm_device'] = 'Desktop';

        // Panggil kode login
        ob_start();
        include "../../_admin/_login.php"; // Gantilah dengan jalur yang sesuai
        $output = ob_get_clean();

        // Periksa apakah pengguna diarahkan kembali ke halaman index.php dengan pesan "Wrong password!"
        $this->assertEquals($output, http_response_code());
    }

}

?>