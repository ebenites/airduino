<?php
class Flash {

    const FLASH_MESSAGE_ID = 'flash-message';

    public static function set($message){
        @session_start();
        $_SESSION[Flash::FLASH_MESSAGE_ID] = $message;
    }

    public static function show(){
        @session_start();
        if (isset($_SESSION[Flash::FLASH_MESSAGE_ID])) {
            echo '<div class="'.Flash::FLASH_MESSAGE_ID.'">'.$_SESSION[Flash::FLASH_MESSAGE_ID].'</div>';
            unset($_SESSION[Flash::FLASH_MESSAGE_ID]);
        }
    }

}
?>
