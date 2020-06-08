<?php
require 'Auto.php';
require 'Igeny.php';

function beolvas(){
    $tomb=array();
    try {
        $file= file_get_contents('autok.csv');
        $sorok= explode("\n", $file);
        for ($i = 0; $i < count($sorok); $i++) {
            $sorok[$i]=substr($sorok[$i],0, strlen($sorok[$i])-1);//1 db karakter maradék, valami jelent meg a férőhely után, ezért nem is enged vele számolni, itt vágom le. 
            if(strlen($sorok[$i])<3){
                
            }else{
            $split= explode(";", $sorok[$i]);
            $o=new Auto(
                    $split[0],
                    $split[1],
                    $split[2], 
                    $split[3], 
                    $split[4]);
            $tomb[]=$o;
            }
            }
    } catch (Exception $exc) {
        die('hiba a beolvasásnál. autok'+$exc);
    }
    array_shift($tomb);
    return $tomb;
}

$a= beolvas();

echo '2. feladat: <br>';
$behuzas='&nbsp&nbsp&nbsp&nbsp&nbsp';
echo $behuzas.count($a).' autós hirdet fuvart. ';
$szamlalo=0;
foreach ($a as $item) {
    if(strcmp($item->getIndulas(),"Budapest")==0 && strcmp($item->getCel(), 'Miskolc')==0){
        $szamlalo+=(int)$item->getFerohely();
    }
}
echo '3. feladat: <br>';
echo $behuzas.'Összesen '.$szamlalo.' férőhelyet hirdettek az autósok Budapestről Miskocra<br>';
echo '4. feladat: <br>';

$ordered=array();
foreach ($a as $item) {
    $talalat=false;
    foreach ($ordered as $ut => $ferohely) {
        if(strcasecmp($item->getIndulas()."-".$item->getCel(),$ut)==0){//ha már benne van a rendezettben az út, akkor a férőhelyet adom hozzá.
            if($ferohely!=0 && $item->getFerohely()!=0){
                $ordered[$item->getIndulas()."-".$item->getCel()]=
                $ferohely+
                $item->getFerohely();
            }
            $talalat=true;
        }
    }
    if($talalat==false){//még nincs az $ordered-ben
        $ordered[$item->getIndulas().'-'.$item->getCel()]=$item->getFerohely();
    }
}
arsort($ordered);
//print_r($ordered);
reset($ordered);
echo $behuzas.'A legtöbb férőhelyet ('. $ordered[key($ordered)].'-et) a '.key($ordered).' útvonalon ajánlották fel a hirdetők. ';

function beolvasIgeny(){
    $tomb=array();
    try {
        $file= file_get_contents('igenyek.csv');
        $sorok= explode("\n", $file);
        for ($i = 0; $i < count($sorok); $i++) {
            $sorok[$i]=substr($sorok[$i],0, strlen($sorok[$i])-1);
            if(strlen($sorok[$i])>3){
                $split= explode(";", $sorok[$i]);
                $o=new Igeny(
                        $split[0],
                        $split[1],
                        $split[2], 
                        $split[3]);
                $tomb[]=$o;
            }
        }
    } catch (Exception $exc) {
        die('hiba a beolvasásnál. igenyek'+$exc);
    }
    array_shift($tomb);
    return $tomb;
}
$b= beolvasIgeny();

echo '5. feladat:<br>';
$fajlba="";
foreach ($b as $igeny) {
    $volt=false;
    foreach ($a as $fuvar) {
        if(strcasecmp($igeny->getIndulas(),$fuvar->getIndulas())==0){
            if(strcasecmp($igeny->getCel(),$fuvar->getCel())==0){
                if($igeny->getSzemelyek()<=$fuvar->getFerohely()){
                    echo $behuzas.
                            $igeny->getAzonosito().
                            ' => '.
                            $fuvar->getRendszam().
                         '<br>';
                    $fajlba.=$igeny->getAzonosito().": Rendszám: ".$fuvar->getRendszam().", Telefonszám: ".$fuvar->getTelefonszam()."\n";
                    $volt=true;
                }
            }
        }
    }
    if($volt==false){
        $fajlba.=$igeny->getAzonosito().": Sajnos nem sikerült autót találni\n";
    }
}

$myFile= fopen("utasuzenetek.txt", "w");
fwrite($myFile, $fajlba);