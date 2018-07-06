<?php

if(!empty($_POST)){


    $errors=array();

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z_]+$/', $_POST['username'])) {

        $errors['username']='Username non valide (alaphanumérique)';
    }

    if(empty($_POST['email']) || !filter_var( $_POST['email'],FILTER_VALIDATE_EMAIL)) {

        $errors['email']='Votre Email n\'est pas valide';
    }

    if(empty($_POST['password']) || $_POST['password']!=$_POST['password_confirm'] ){

        $errors['password']="Votre Mot de Passe n'est pas valide";
    }

    debug($errors);

}

if (empty($errors)){





}


?>


<h1>S'inscrire</h1>



<form action="" method="post" >

    <div class="form-group">

        <label for="">Pseudo</label>
        <input type="text" name="username" class="form-inline"  />

    </div>


    <div class="form-group">

        <label for="">Email</label>
        <input type="text" name="email" class="form-inline"  />

    </div>


    <div class="form-group">

        <label for="">Mot de passe</label>
        <input type="password" name="password" class="form-inline"  />

    </div>


    <div class="form-group">

        <label for="">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-inline"  />

    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>


