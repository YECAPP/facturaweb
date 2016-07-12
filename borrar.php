<?php
	session_start();
	echo $_SESSION['user_session']."<br><br><br>";
	echo $_SESSION['idUser_session']."<br><br><br>";
	require_once 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
    $idvendor=$_SESSION['idUser_session'];

    echo "str len es :";
    echo strlen($idvendor);
    echo "<br><br><br>";


    $sql2="SELECT MAX(NUMERO) as NUM FROM y_factura WHERE IDVENDEDOR=:idvendor";
    $stmt2 = $pdo->prepare($sql2);
	$rows2 = $stmt2->execute(array(':idvendor'=>$idvendor));
	$idMaxNum=$rows2["NUM"];

	if ($idMaxNum==""){
		echo "001";	
	}else{
		echo $idMaxNum;
	}

    echo "<br><br><br>";
	$sql="SELECT MAX(NUMERO) as NUM FROM y_factura WHERE IDVENDEDOR=".$idvendor;
	$row1=$pdo->query($sql);
	$value=$row1.fetch();

	echo $value;
	echo "<br><br><br>";
	foreach ($pdo->query($sql) as $row) {
        print $row['NUM'] . "\t";
    }


?>