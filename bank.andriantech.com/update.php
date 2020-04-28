<?php
include "database.php";
session_start();

$userlogin = $_SESSION['login'];

//table1
$query = "SELECT * FROM user WHERE id = '$userlogin'";
$data = $db->prepare($query);
$data->execute();

$user = $data->fetch();
$id = $user['id'];

//table 2
$query2 = "SELECT * FROM saldo WHERE id = '$id'";
$data2 = $db->prepare($query2);
$data2->execute();

$saldo = $data2->fetch();
$uang = $saldo['uang'];


//UPDATE DATA DIRI
//ganti Nama
if (isset($_POST['gantiNama'])) {
    $namaBaru = $_POST['editNama'];

    $queryUpdate = "UPDATE user SET nama= '$namaBaru' WHERE id = '$id'";
    $data2 = $db->prepare($queryUpdate);
    $data2->execute();
    header("Location: profil.php?msg=data berhasil diubah");
}

//Ganti email
if (isset($_POST['gantiEmail'])) {
    $email = $_POST['emailLama'];
    $emailBaru = $_POST['emailBaru'];

    if ($email == $user['email']) {
        $queryUpdate = "UPDATE user SET email= '$emailBaru' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();

        header("Location: profil.php?msg=Email berhasil diperbaharui");
    } else {

        header("Location: profil.php?msg=Email salah");
    }
}

//Ganti email
if (isset($_POST['gantiPass'])) {
    $pass = $_POST['pass1'];
    $passBaru = $_POST['pass2'];

    $hash = md5($pass);

    if ($hash == $user['password']) {


        $hashBaru = md5($passBaru);

        $queryUpdate = "UPDATE user SET user.password= '$hashBaru' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();

        header("Location: profil.php?msg=Password berhasil diperbaharui");
    } else {

        header("Location: profil.php?msg=Password lama salah");
    }
}

//reset Pass
if (isset($_POST['resetPass'])) {
    $email = $_POST['email'];
    $passBaru = "admin";

    $hashBaru = md5($passBaru);

    if (!empty($email)) {

        $queryUpdate = "UPDATE user SET user.password= '$hashBaru' WHERE email = '$email'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();

        header("Location: forgot-password.php?msg=Passsword telah menjadi default 'admin'");
    } else {

        header("Location: forgot-password.php?msg=Email salah");
    }
}
//END UPDATE DATA DIRI




//UPDATE SALDO
//PEMBAYARAN

//Pulsa
if (isset($_POST['beliPulsa'])) {
    $pulsa = $_POST['pulsa'];

    $id = $user['id'];

    if ($uang > 0) {
        $queryUpdate = "UPDATE saldo SET uang = uang-'$pulsa' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();
        header("Location: index.php?msg= Pulsa berhasil dikirim");
    } else {
        header("Location: index.php?msg= Saldo tidak cukup");
    }
}

//Listrik
if (isset($_POST['bayarListrik'])) {
    $listrik = $_POST['listrik'];

    $id = $user['id'];

    if ($uang > 0) {
        $queryUpdate = "UPDATE saldo SET uang = uang-'$pulsa' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();
        header("Location: index.php?msg= Token Listrik berhasil dibeli");
    } else {
        header("Location: index.php?msg= Saldo tidak cukup");
    }
}

//UPDATE KEUANGAN

//Isi saldo
if (isset($_POST['isiSaldo'])) {
    $isi = $_POST['nominal'];

    $id = $user['id'];

    if ($uang > 0) {
        $queryUpdate = "UPDATE saldo SET uang = uang+'$isi' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();
        header("Location: index.php?msg=Selamat! Menambahkan saldo berhasil");
    } else {
        header("Location: index.php?msg= Saldo tidak cukup");
    }
}

//Transfer
if (isset($_POST['transferSaldo'])) {
    $transfer = $_POST['transfer'];

    $id = $user['id'];

    if ($uang > 0) {
        $queryUpdate = "UPDATE saldo SET uang = uang-'$transfer' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();
        header("Location: index.php?msg=Transfer Saldo berhasil");
    } else {
        header("Location: index.php?msg= Saldo tidak cukup");
    }
}

//Transfer
if (isset($_POST['bayarTiket'])) {
    $pay = $_POST['pay'];

    $id = $user['id'];

    if ($uang > 0) {
        $queryUpdate = "UPDATE saldo SET uang = uang-'$pay' WHERE id = '$id'";
        $data2 = $db->prepare($queryUpdate);
        $data2->execute();
        header("Location: index.php?msg=Pembelian Tiket berhasil");
    } else {
        header("Location: index.php?msg= Saldo tidak cukup");
    }
}

//Transfer
if (isset($_POST['mintaSaldo'])) {
    $minta = $_POST['minta'];

    header("Location: index.php?msg=Permintaan sudah dikirim. Menunggu persetujuan");
}
