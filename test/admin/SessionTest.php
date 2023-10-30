<?php


class SessionTest extends PHPUnit\Framework\TestCase
{
    protected $dbconn;

    protected function setUp(): void
    {
      require "../../system/sistem.php";
        dbConnect(); // Connect to the database
        session_start();
        $this->dbconn = $GLOBALS['dbconn']; // Get the database connection for testing
    }

    public function testSessionExpiration()
    {
      require "../../system/sistem.php";
        $_SESSION['LAST_ACTIVITY'] = time() - 3601; // Simulate an expired session
        $_SESSION['TIME_DURATION'] = 3600;

        ob_start();
        include 'your_code.php'; // Include your code to test
        $output = ob_get_clean();

        $this->assertStringContainsString('Session Expired!', $output);
    }

    public function testUnauthorizedAccess()
    {
      require "../../system/sistem.php";
        $_SESSION['ses_username'] = 'test_user';
        $_SESSION['ses_hak'] = 'guest'; // Simulate unauthorized access

        ob_start();
        include 'your_code.php'; // Include your code to test
        $output = ob_get_clean();

        $this->assertStringContainsString('Forbidden Access!', $output);
    }

    public function testAuthorizedAccess()
    {
      require "../../system/sistem.php";
        $_SESSION['ses_username'] = 'test_user';
        $_SESSION['ses_hak'] = 'administrator'; // Simulate authorized access

        ob_start();
        include 'your_code.php'; // Include your code to test
        $output = ob_get_clean();

        $this->assertStringNotContainsString('Forbidden Access!', $output);
        $this->assertStringContainsString('<!-- Your code output -->', $output); // Add expected output
    }

    protected function tearDown(): void
    {
        // Clean up after each test if needed
    }
}
