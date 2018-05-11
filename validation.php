<?php

  function user_val($value) {
    if (preg_match('/^[A-Z0-9]{1}[a-z]{1,15}$/', $value)) {
      return true;
    } else {
      return false;
    }
  }
// Nazwa użytkownika musi rozpoczynać się od dużej litery i mieć max 16 znaków
  function mail_val($value) {
    test_input($value);
    if(filter_var($value, FILTER_VALIDATE_EMAIL)){
      return true;
    } else {
      return false;
    }
  }

  function password_val($value) {
    if(preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,20}$/', $value)) {
      return true;
    }
     else {
       return false;
     }
  }

  // Hasło musi składać się z min 8 max 20 znaków i zawierać duże i małe literki, min 1 cyfre i min 1 znak specjlany.


 ?>
