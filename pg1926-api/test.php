<?php
/**
 * Created by AENMaster.
 * User: Casper-Pc
 * Date: 17.01.2021
 * Time: 16:01
 * Project Name: TheKule
 *
 * OOP - A PHP Framework For KuleV2
 * Emrah NALCI - Artisan Web Developer
 * @author Emrah NALCI <emrahnalci@gmail.com & ptr@emrahnalci.com.tr>
 *
 */


$snc = file_get_contents('https://www.tasarlayici.net/pg1926-api/?kullanici=pg1926&parola=123456789');

$snc = json_decode($snc)->id;
echo $snc;