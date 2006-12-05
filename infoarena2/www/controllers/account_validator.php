<?php

// validates registration input data (wrapper for validate_data)
function validate_register_data($data) {
    return validate_user_data($data, true, null);
}

// validates user profile input data (wrapper for validate_data)
function validate_profile_data($data, $user) {
    return validate_user_data($data, false, $user);
}

// validate fields found in register/profile forms
function validate_user_data($data, $register, $user = null) {
    $errors = array();

    log_assert($register ^ $user);

    // username
    if ($register) {
        if (!$data['username']) {
            $errors['username'] = 'Nu ati specificat numele de utilizator.';
        }
        elseif (4 > strlen(trim($data['username']))) {
            $errors['username'] = 'Nume de utilizator este prea scurt.';
        }
        elseif (16 < strlen(trim($data['username']))) {
            $errors['username'] = 'Nume de utilizator este prea lung.';
        }
        elseif (!preg_match('/^[a-z]+[a-z0-9_\-\.]*$/i', $data['username'])) {
            $errors['username'] = 'Numele utilizator contine caractere '
                                  .'invalide.';
        }
        elseif (user_get_by_username($data['username'])) {
            $errors['username'] = 'Nume utilizator rezervat de altcineva. Va '
                                  .'rugam alegeti altul.';
        }
    }

    // email
    if (!$data['email']) {
        $errors['email'] = 'Nu ati introdus adresa de e-mail.';
    }
    elseif (!preg_match('/[^@]+@.+\..+/', $data['email'])) {
        $errors['email'] = 'Adresa de e-mail introdusa este invalida.';
    }

    // changing e-mail address or specifying new password forces user
    // to enter enter current password
    if (!$register && ($user['email'] != $data['email'])) {
        if (!$data['passwordold']) {
            $errors['passwordold'] = 'Introdu parola curenta (veche) pentru a '
                                      .'schimba adresa de e-mail.';
        }
    }

    // changing password forces user to enter current password
    if (!$register && ($data['password'] || $data['password2'])) {
        if (!$data['passwordold']) {
            $errors['passwordold'] = 'Introdu parola curenta (veche) pentru a '
                                     .'o schimba.';
        }
    }

    // When registering or changing e-mail address, make sure e-mail is unique
    if ($register || ($user['email'] != $data['email'])) {
        if (user_get_by_email($data['email'])) {
            $errors['email'] = 'Adresa de e-mail este deja asociata unui cont!'
                               .' Reseteaza-ti parola daca ai uitat-o.';
        }
    }

    // password
    if ($register || $data['password'] || $data['password2']) {
        if (!$data['password']) {
            $errors['password'] = 'Nu ati introdus parola.';
        }
        elseif (4 > strlen(trim($data['password']))) {
            $errors['password'] = 'Parola introdusa este prea scurta.';
        }
        elseif ($data['password'] != $data['password2']) {
            $errors['password2'] = 'Parolele nu coincid.';
        }
    }

    // current password
    if (!$register && $data['passwordold']) {
        if (!user_test_password($user['username'], $data['passwordold'])) {
            $errors['passwordold'] = 'Nu aceasta este parola curenta!';
        }
    }

    // full name
    if (6 > strlen(trim($data['full_name']))) {
        $errors['full_name'] = 'Nu ati completat numele.';
    }
    elseif (!preg_match('/^[a-z]+[a-z0-9\-\. ]+$/i', $data['full_name'])) {
        $errors['full_name'] = 'Numele contine caractere invalide.';
    }

    // terms & conditions
    if ($register && !$data['tnc']) {
        $errors['tnc'] = 'Ca sa te inregistrezi trebuie sa fii de acord cu '
                         .'aceste conditii.';
    }

    return $errors;
}

?>