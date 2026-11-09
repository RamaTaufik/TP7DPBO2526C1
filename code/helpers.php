<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Fungsi-fungsi helper untuk berbagai macam kebutuhan

// Yang satu ini untuk get-set flash message, yaitu session sekali pakai
function flash(string $name, string $message = '', string $type = 'error') {
  if(!empty($message)) {
    $_SESSION['flash_'.$name] = [
      'message' => $message,
      'type' => $type
    ];
  } else {
    if(isset($_SESSION['flash_'.$name])) {
      $flash = $_SESSION['flash_'.$name];
      // Langsung hapus session
      unset($_SESSION['flash_'.$name]);
      
      return $flash;
    }
  }

  return NULL;
}
