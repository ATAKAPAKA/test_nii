<?

namespace vendor\log;

class LogWriter{
    private $all_log = "/log/log.log";
    private $error_log = "/log/error.log";
    private $warning_log = "/log/warning.log";

    public function __construct(string $message, string $status = "info") {
        $message = date('Y-m-d H:i:s', time()).$message." IP Пользователя: $_SERVER[REMOTE_ADDR] \n";
        $file = fopen($_SERVER["DOCUMENT_ROOT"].$this->all_log, "a");
        if($file){
            fwrite($file, $message);
            fclose($file);
        }
        if($status == "error"){
            $file = fopen($_SERVER["DOCUMENT_ROOT"].$this->error_log, "a");
            if($file){
                fwrite($file, $message);
                fclose($file);
            }
        }
        else if($status == "warning"){
            $file = fopen($_SERVER["DOCUMENT_ROOT"].$this->warning_log, "a");
            if($file){
                fwrite($file, $message);
                fclose($file);
            }
        }
    }
}