<?php

namespace src\test;

class TestFunctions {
    public function allExecuteFunction(): void {
        //$this->testVarDump();
        //$this->testPrintR();
        //$this->testFilePutContents();
        $this->testErrorLog();
        $this->testSyslog();
    }

    public function testVarDump(): void {
        $variable = ['var_apple', 'var_banana', 'var_cherry'];
        var_dump($variable);
    }

    public function testPrintR(): void {
        $variable = ['apple', 'banana', 'cherry'];
        print_r($variable);
    }

    public function testFilePutContents(): void {
        $log_message = "This is a log message.";
        file_put_contents('log.txt', $log_message . "\n", FILE_APPEND);
    }

    public function testErrorLog(): void {
        error_log("This is an error log message.");
    }

    public function testSyslog(): void {
        openlog("MyAppName", LOG_PID | LOG_PERROR, LOG_USER);
        syslog(LOG_INFO, "This is a syslog message.");
        closelog();
    }

}