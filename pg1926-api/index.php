<?php
/**
 * Created by AENMaster.
 * User: Casper-Pc
 * Date: 17.01.2021
 * Time: 14:48
 * Project Name: TheKule
 *
 * OOP - A PHP Framework For KuleV2
 * Emrah NALCI - Artisan Web Developer
 * @author Emrah NALCI <emrahnalci@gmail.com & ptr@emrahnalci.com.tr>
 *
 */

// header('Access-Control-Allow-Origin: *');
// header("Content-type: application/json; charset=utf-8");

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$database = "pg1926api";


$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Bağlantı Hatası: " . mysqli_connect_error());
}
$conn->set_charset("utf8");

if(isset($_REQUEST["kullanici"]) == TRUE AND isset($_REQUEST["parola"]) == TRUE){
    $kullanici = addslashes(strip_tags($_REQUEST["kullanici"]));
    $parola = addslashes(strip_tags($_REQUEST["parola"]));

    $sql = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM kullanicilar WHERE kullanici_adi='".$kullanici."' AND parola='".$parola."'"));
    if(@$sql->id > 0){
        echo json_encode([
            "durum" => 1,
            "aciklama" => "Başarılı",
            "kullanici" => [
                "id" => $sql->id,
                "kullanici_adi" => $sql->kullanici_adi,
                "isim" => $sql->isim,
                "soyisim" => $sql->soyisim,
                "isimsoyisim" => $sql->isim." ".$sql->soyisim,
                "kayitTarihi" => $sql->olusturma_tarihi
            ],
        ], JSON_UNESCAPED_UNICODE);
    }
    else {
        echo json_encode([
            "durum" => 0,
            "aciklama" => "Kullanıcı adı veya parola hatalı!"
        ], JSON_UNESCAPED_UNICODE);
    }
}
else {
    echo json_encode([
        "durum" => 0,
        "aciklama" => "Hatalı Parametre !"
    ], JSON_UNESCAPED_UNICODE);
}


/*
function sefLinks($string){
    $tr = array("ş", "Ş", "ı", "ü", "Ü", "ö", "Ö", "ç", "Ç", "ğ", "Ğ", "İ");
    $lWord = array("s", "s", "i", "u", "u", "o", "o", "c", "c", "g", "g", "i");
    $string = str_replace($tr, $lWord, $string);
    $string = trim($string);
    $string = html_entity_decode($string);
    $string = strip_tags($string);
    $string = strtolower($string);
    $string = preg_replace('~[^ a-z0-9_.]~', ' ', $string);
    $string = preg_replace('~ ~', '', $string);
    $string = preg_replace('~-+~', '', $string);
    return $string;
}



for($i=0; $i<2000; $i++){
    $isim = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM isimler ORDER BY RAND() LIMIT 1"))->isimler;
    $soyisim = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM soyisim ORDER BY RAND() LIMIT 1"))->soyisim;

    $kullanici_adi = sefLinks($isim."".$soyisim);
    $parola = rand(681768,99999999999);

    $sql = mysqli_query($conn,"INSERT INTO kullanicilar (kullanici_adi, parola, isim, soyisim, olusturma_tarihi) VALUES ('".$kullanici_adi."','".$parola."','".$isim."','".$soyisim."','".date("Y-m-d H:i:s")."')");
}
*/



mysqli_close($conn);
