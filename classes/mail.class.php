<?php
    class Mail{

        static public function sendNewAccountMail(Admin_Users_Models_UserModel $user, $unhashed_pass){
            //build body
            $body_ar[] = HTML::H1('Hallo!');
            $body_ar[] = HTML::P('Er is een gebruikersaccount voor je aangemaakt met de volgende gegevens.');
            $body_ar[] = HTML::P('Gebruikersnaam: <strong>'. $user->records_ar->email.'<strong>');
            $body_ar[] = HTML::P('Wachtwoord: <strong>'. $unhashed_pass.'</strong>');
            $args_ar['href'] = 'http://www.silkmedia.nl/ys';
            $body_ar[] = HTML::A('Link naar het systeem', $args_ar);
            return self::send($user->records_ar->email, 'Yellow-Stone: Nieuw account', $body_ar);
        }

        static private function send($to, $subject, $body_ar = array()){
            $header = "From: no-reply@silkmedia.nl\r\n"; 
            $header.= "MIME-Version: 1.0\r\n"; 
            $header.= "Content-Type: text/html; charset=utf-8\r\n"; 
            $header.= "X-Priority: 1\r\n"; 
            $header.= 'X-Mailer: PHP/' . phpversion();        
            return mail($to, $subject, implode('', $body_ar), $header);
        }
    }
?>