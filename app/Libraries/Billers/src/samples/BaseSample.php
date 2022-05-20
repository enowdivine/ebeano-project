<?php
    namespace Billers\samples;
    use Billers\BillPayment;
    use Interswitch\Interswitch;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class BaseSample{
        
        // TEST Environment credentials
        // var $clientId = "IKIA2EFBE1EF63D1BBE2AF6E59100B98E1D3043F477A";
        // var $clientSecret="uAk0Amg6NQwQPcnb9BTJzxvMS6Vz22octQglQ1rfrMA=";

        var $clientId = "IKIA6570778A3484D6F33BC7E4165ADCA6CF06B2860A";
        var $clientSecret="DXfUwpuIvMAKN84kv38uspqGOsStgFS0oZMjU7bPwpU=";
        var $billPayment;

        public function __construct(){
            $this->billPayment = new BillPayment($this->clientId, $this->clientSecret, Interswitch::ENV_SANDBOX);
        }
    }
?>