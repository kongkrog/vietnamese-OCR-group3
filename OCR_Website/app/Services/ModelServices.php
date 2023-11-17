<?php

namespace App\Services;
use App\Services\BaseServices;
use App\Models\UserModel;
use App\Common;
use App\Common\ResultUtils;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class ModelServices extends BaseServices
{
    private $users;
    public function __construct(){
        /**
         * Construct
         */
        parent::__construct();
        $this->users = new UserModel();
        $this ->users ->protect(false);
    }

    public function executeCommandWithTimeout($command, $timeout) {
        $descriptorspec = array(
            0 => array("pipe", "r"), // stdin
            1 => array("pipe", "w"), // stdout
            2 => array("pipe", "w")  // stderr
        );
    
        $process = proc_open($command, $descriptorspec, $pipes);
    
        if (!is_resource($process)) {
            die("Failed to execute command.");
        }
    
        // Set stream to non-blocking mode
        stream_set_blocking($pipes[1], 0);
        stream_set_blocking($pipes[2], 0);
    
        $stdout = '';
        $stderr = '';
        $startTime = time();
    
        while (true) {
            $read = array($pipes[1], $pipes[2]);
            $write = null;
            $except = null;
    
            // Wait for streams to change state or until timeout
            $timeoutRemaining = $timeout - (time() - $startTime);
    
            if ($timeoutRemaining <= 0) {
                // Timeout reached, terminate the process
                proc_terminate($process, 9);
                proc_close($process);
                return array('timeout' => true, 'stdout' => $stdout, 'stderr' => $stderr);
            }
    
            $numChangedStreams = stream_select($read, $write, $except, 0, $timeoutRemaining * 1000000);
    
            if ($numChangedStreams === false) {
                // An error occurred
                break;
            } elseif ($numChangedStreams > 0) {
                foreach ($read as $stream) {
                    if ($stream == $pipes[1]) {
                        $stdout .= fread($pipes[1], 8192);
                    } elseif ($stream == $pipes[2]) {
                        $stderr .= fread($pipes[2], 8192);
                    }
                }
            }
    
            // Check if the process has terminated
            $status = proc_get_status($process);
            if (!$status['running']) {
                break;
            }
        }
    
        // Close streams
        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);
    
        // Close process and get return code
        $returnCode = proc_close($process);
    
        return array('timeout' => false, 'stdout' => $stdout, 'stderr' => $stderr, 'return_code' => $returnCode);
    }
}