<?php
session_start();
$email=$_POST["email"];
$password=$_POST["password"];
$userCount=0;
try

{

	$bdd = new PDO('mysql:host=localhost;dbname=Broceliande_Triathlon;charset=utf8', 'root', '');

}

catch(Exception $e)

{

        die('Erreur : '.$e->getMessage());
        print("rebonjour");

}

$verif = $bdd->prepare('SELECT * FROM Compte WHERE email = ?');
$verif->execute(array($email));
$userCount = $verif->rowCount();
if($userCount==1)
{
    $userInfo = $verif->fetch();
    //$hash=password_verify($password, $userInfo['mdp']);
    if($userInfo['Hash']==$password){
        $_SESSION['ID'] = $userInfo['ID'];
        $_SESSION['email'] = $userInfo['email'];
        $_SESSION['type_de_compte'] = $userInfo['type_de_compte']; 
        $_SESSION['Prenom'] = $userInfo['Prenom']; 
        $_SESSION['Nom'] = $userInfo['Nom']; 
//         $req = $bdd->prepare('INSERT INTO logs(id, date, heure, ip) 
//         VALUES(:id, :date, :heure, :ip)');
//         if($_SESSION['rank']==10){
//         $ip = $_SERVER['REMOTE_ADDR'];
//         $id = $userInfo['id'];
//         $dates = date('d-m-y');
//         $heures = date('h:i:s');
//         $req->execute(array(
//             'id' => $id,
//             'date' => $dates,
//             'heure' => $heures,
//             'ip' => $ip
//         ));
//            header('Location:admin.php');
//            exit; 
//         }
//        else{ 
//         $ip = $_SERVER['REMOTE_ADDR'];
//         $id = $userInfo['id'];
//         $dates = date('d-m-y');
//         $heures = date('h:i:s');
//         $req->execute(array(
//             'id' => $id,
//             'dates' => $date,
//             'heures' => $email,
//             'ip' => $ip,
//         ));
//            header('Location:membres.php');
//            exit;
//        }
        header('Location:hub.php');
        exit;
     }
        header('Location:index.html');
        exit;
 }

header('Location:index.html');

exit;
?>