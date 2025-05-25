<?php

$mahasiswa = [
    [
        "nama" => "atil",
        "nip" => "2217020025",
        "email" => "Mukhairatil24@gmail.com"
    ],
    [
        "nama" => "alim",
        "nip" => "2217020025",
        "email" => "alim@gmail.com"
    ],
];

// $dbh = new PDO('mysql:host=localhost;dbname=db_dt8', 'root', '');
// $db = $dbh->prepare('SELECT * FROM tb_user');
// $db->execute();
// $mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo $data;

?>