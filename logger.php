<?php

class Logger {

    private static $instance = null;
    private $f_handle = null;
    private $logger_file = "/tmp/simple_engine.log";

    public function __construct() {
        $this->f_handle = fopen($this->logger_file, "a+");
    }

    public function write($msg) {
        $msg .= "\n";
        fwrite($this->f_handle, $msg);
    }

    public function __destruct() {
        fclose($this->f_handle);
    }

    public static function GetLogger() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>