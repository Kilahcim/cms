<?php
include_once('init.php');

class User {

  private $db;

  public function __construct($connect){

    //  W tym miejscu tworzymy obiekt, który zapewnia nam połączenie
    $this->db = $connect;
    // // wzywamy metode w naszej klasie
    // $this->db = $this->db->dbConnect();

    // $this->db->dbConnect(); to zwraca obiekt PDO, a to wszystko przypisaliśmy do zmiennej db
  }

  public function is_logged() {
    if($_SESSION['is_logged'] == 'true') {
      return true;
    } else {
      return false;
    }
  }

  public function log_in($user, $pass) {

    if($this-> is_logged()) {
      $_SESSION['message'][] = 'Witaj' . ' ' . $user . ' ' . 'Jestes juz zalogowany';
      header('Location: home.php');
      exit();

    } else {
      if (user_val($user)) {
        $query = $this->db->prepare('SELECT password FROM users WHERE name =:user');
        $query->bindValue(':user', $user);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_NUM);

        if(password_verify($pass, $result[0][0]) && password_val($pass)) {
          $_SESSION['is_logged'] = 'true';
          $_SESSION['modal_messages'] = 'Witaj' . ' ' . $user;
          $_SESSION['user_name'] = $user;

          $query = $this->db->prepare('SELECT * FROM users WHERE name = :name');
          $query->bindValue(':name', $user);
          $query->execute();
          $result = $query->fetchAll();

          $_SESSION['account_details'] = $result;

          header('Location: home.php');
          exit();
        } else {
           $_SESSION['modal_messages'] = 'Wprowadzono niepoprawne hasło!';
           header('Location: index.php');
           exit();
           // tą wiadomość będę obsługiwał if sprawdzającym i jeżeli są zmienne messages w pliku index.php
        }
      } else {
        $_SESSION['modal_messages'] = 'Wprowadzono niepoprawną nazwę użytkownika';
      }
    }
  }

  public function log_out() {
    $_SESSION = Array();


  }

  public function Register($user, $email, $pass1, $pass2, $privilages) {

    if(($pass2 == $pass1) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && (password_val($pass1)) && password_val($pass2) && user_val($user) ) {

      $query = $this->db->prepare('SELECT name, mail FROM users WHERE name = :name OR mail = :email');
      $query->bindValue(':name', $user);
      $query->bindValue(':email',$email);
      $query->execute();
      $result = $query->fetchAll();

      $_SESSION['result'] = $result;

      if(empty($result)){
        $query = $this->db->prepare('INSERT INTO users VALUES(NULL, :name, :email, :password, :privilages )');
        $query->bindValue(':name', $user);
        $query->bindValue(':email',$email);
        $query->bindValue(':password', password_hash($pass1, PASSWORD_DEFAULT));
        $query->bindValue(':privilages', $privilages);
        $query->execute();

        $result = $query->fetchAll();
        $_SESSION['modal_messages'] = 'Dziękujemy za rejestracje!' . ' ' . $user;
        header('Location: index.php');
        exit();
      } else {
        $_SESSION['modal_messages'] = 'Podałeś istniejące dane sprawdź je!';
        header('Location: index.php');
        exit();
      }
    } else {
      $_SESSION['modal_messages'] = 'Podałeś niepoprawne dane sprawdź je!';
      header('Location: index.php');
      exit();
    }
  }

  public function name_edit($email, $new_name, $password) {

    if (user_val($new_name) && (filter_var($email, FILTER_VALIDATE_EMAIL) ) ) {

      $query = $this->db->prepare("SELECT password FROM users WHERE mail =:email");
      $query->bindValue(':email', $email);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_NUM);

      $_SESSION['result'] = $result;


      if(password_verify($password , $result[0][0] ) && password_val($password) ){
        $query = $this->db->prepare("UPDATE users SET name= :name WHERE mail= :email");
        $query->bindValue(':name', $new_name);
        $query->bindValue(':email', $email);
        $query->execute();
        $_SESSION['user_name'] = $new_name;

        $_SESSION["modal_messages"] = 'Nazwa użytkonika została zmieniona';
        // header('Location: profile.php');
        // exit();


      } else {
        $_SESSION['modal_messages'] = 'Podane hasło jest nieodpowiednie';
        // header('Location: profile.php');
        // exit();

      }
    } else {
      $_SESSION['modal_messages'] = 'Podałeś błędny mail bądź wprowadzono złą nazwę użytkownika';
      // header('Location: profile.php');
      // exit();

    }
  }

  public function email_edit($user, $email, $new_email, $password){
    if(user_val($user) && ( filter_var($email, FILTER_VALIDATE_EMAIL) ) ) {
      $_SESSION['test'] = '1wszy if email edit';
      $query = $this->db->prepare("SELECT password FROM users WHERE mail =:email");
      $query->bindValue(':email', $email);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_NUM);

      $_SESSION['result'] = $result;
      if(password_verify($password, $result[0][0]) && password_val($password)) {
        $query = $this->db->prepare("UPDATE users SET mail = :email WHERE name = :name");

        $query->bindValue(':email', $new_email);
        $query->bindValue(':name', $user);
        $query->execute();

        $_SESSION['modal_messages'] = 'Mail został zmieniony';
        // header('Location: profile.php');
        // exit();

      } else {
        $_SESSION['modal_messages'] = 'Podane hasło jest nieodpowiednie';
        // header('Location: profile.php');
        // exit();
      }
    } else {
      $_SESSION['modal_messages'] = 'Podałeś błędny mail bądź wprowadzono złą nazwę użytkownika';
      // header('Location: profile.php');
      // exit();
    }
  }

  public function password_edit($user, $email, $password, $new_pass1, $new_pass2) {
    if(user_val($user) && ( filter_var($email, FILTER_VALIDATE_EMAIL) ) ) {

      $query = $this->db->prepare("SELECT password FROM users WHERE mail =:email");
      $query->bindValue(':email', $email);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_NUM);

      if(password_verify($password, $result[0][0])){
        if(password_val($password) && password_val($new_pass1) && password_val($new_pass2)) {
          if($new_pass1 == $new_pass2) {
            $query = $this->db->prepare("UPDATE users SET password = :new_pass WHERE mail = :email");
            $query->bindValue(':email', $email);
            $query->bindValue(':new_pass', password_hash($new_pass1, PASSWORD_DEFAULT));
            $query->execute();
            $_SESSION['modal_messages'] = 'Hasło zostało zmienione';
          } else {
            $_SESSION['modal_messages'] = 'Hasła nie są jednakowe';
          }
        } else {
          $_SESSION['modal_messages'] = 'Wprowadzono hasła niezgodne ze wskazówkami';
          }
        } else {
          $_SESSION['modal_messages'] = 'Wprowadzono błędne hasło';
        }
      } else {
        $_SESSION['modal_messages'] = 'Wprowadzono złą nazwę użytkownika bądź zły adres email';
      }
    }

  public function delete_account($user, $email, $password) {
    if(user_val($user) && ( filter_var($email, FILTER_VALIDATE_EMAIL) ) ) {

      $query = $this->db->prepare("SELECT password FROM users WHERE mail =:email");
      $query->bindValue(':email', $email);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_NUM);

      if(password_verify($password, $result[0][0])){
        $query = $this->db->prepare("DELETE FROM users WHERE mail = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        $_SESSION['modal_messages'] = 'Użytkownik został usunięty';
        header('Location: index.php');
        exit();

        } else {
          $_SESSION['modal_messages'] = 'Wprowadzono błędne hasło';
        }
    } else {
      $_SESSION['modal_messages'] = 'Wprowadzono złą nazwę użytkownika bądź zły adres email';
    }
  }
  public function delete_user($id) {
    $query = $this->db->prepare("DELETE FROM users WHERE user_id = :id");
    $query->bindValue(':id', $id);
    $query->execute();
    $_SESSION['modal_messages'] = 'Wybrany użytkownik został usunięty';
  }

  public function edit_user($name, $email, $privileges, $id) {
    $query =$this->db->prepare("UPDATE users SET name= :name, mail= :email, privileges = :privileges WHERE user_id = :id");
    $query->bindValue(':name' , $name);
    $query->bindValue(':email', $email);
    $query->bindValue(':privileges', $privileges);
    $query->bindValue(':id' , $id);
    $query->execute();
    $_SESSION['modal_messages'] = 'Wybrany użytkownik został zedytowany';
  }


  // public function
}

class Article {
  private $db;

  public function __construct($connect) {
    $this->db = $connect;
  }

  public function add_article($tytul, $tresc, $autor) {

     $query = $this->db->prepare("INSERT INTO artykuly VALUES(NULL, :tytul, :tresc, :autor, NOW(), NOW())");
     $query->bindValue(':tytul', $tytul);
     $query->bindValue(':tresc', $tresc);
     $query->bindValue(':autor', $autor);
     $result=$query->execute();


     $_SESSION['modal_messages'] =  'Twój artykuł został pomyślnie dodadny';
  }
  public function edit_article($tytul, $tresc, $autor, $publication_date, $update_date, $id) {
    $query = $this->db->prepare("UPDATE artykuly SET Tytul= :tytul, tresc= :tresc, autor= :autor, data= :p_date, data_aktualizacji= :u_date WHERE id_artykulu = :id");
    $query->bindValue(':tytul', $tytul);
    $query->bindValue(':tresc', $tresc);
    $query->bindValue(':autor', $autor);
    $query->bindValue(':p_date', $publication_date);
    $query->bindValue(':u_date', $update_date);
    $query->bindValue(':id', $id);
    $query->execute();

    $_SESSION['modal_messages'] = 'Wybrany artykuł został pomyślnie edytowany';
  }

  public function delete_article($id) {
    $query = $this->db->prepare("DELETE FROM artykuly WHERE id_artykulu = :id");
    $query->bindValue(':id', $id);
    $query->execute();
    $_SESSION['modal_messages'] = 'Wybrany artykuł został usunięty';
  }
}

class Show {
  private $db;

  public function __construct($connect) {
    $this->db = $connect;
  }

  public function show_articles() {
    $query = $this->db->query("SELECT * FROM artykuly");
    $query->execute();
    // Tutaj zostawiam podwójne wykonanie kwerendy bo już w home.php zagnieździłem się max w tych tabelach wynikowych
    $result = $query->fetchAll(PDO::FETCH_NUM);
    $_SESSION['result'] = $result;

  }
  public function show_selected($id) {
    $id = (int)$id;
    $query = $this->db->prepare("SELECT * FROM artykuly WHERE id_artykulu = :id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll();
    $_SESSION['result'] = $result;
  }

  public function show_user() {
    $query = $this->db->query("SELECT user_id, name, mail, privileges FROM users");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['user_list'] = $result;
  }
}
?>
