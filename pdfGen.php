<?php
require('pdf/fpdf.php');
require_once('php/database.php');

// Crear una instancia de la clase Database
$database = new Database();

class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

protected $T128;                                         // Tableau des codes 128
    protected $ABCset = "";                                  // jeu des caractères éligibles au C128
    protected $Aset = "";                                    // Set A du jeu des caractères éligibles
    protected $Bset = "";                                    // Set B du jeu des caractères éligibles
    protected $Cset = "";                                    // Set C du jeu des caractères éligibles
    protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
    protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
    protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
    protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu
    
    //____________________________ Extension du constructeur _______________________
    function __construct($orientation='P', $unit='mm', $size='A4') {
    
        parent::__construct($orientation,$unit,$size);
    
        $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
        $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
        $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
        $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
        $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
        $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
        $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
        $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
        $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
        $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
        $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
        $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
        $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
        $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
        $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
        $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
        $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
        $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
        $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
        $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
        $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
        $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
        $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
        $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
        $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
        $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
        $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
        $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
        $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
        $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
        $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
        $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
        $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
        $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
        $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
        $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
        $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
        $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
        $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
        $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
        $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
        $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
        $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
        $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
        $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
        $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
        $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
        $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
        $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
        $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
        $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
        $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
        $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
        $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
        $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
        $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
        $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
        $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
        $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
        $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
        $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
        $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
        $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
        $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
        $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
        $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
        $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
        $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
        $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
        $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
        $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
        $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
        $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
        $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
        $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
        $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
        $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
        $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
        $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
        $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
        $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
        $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
        $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
        $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
        $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
        $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
        $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
        $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
        $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
        $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
        $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
        $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
        $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
        $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
        $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
        $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
        $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
        $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
        $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
        $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
        $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
        $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
        $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
        $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
        $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
        $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
        $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
        $this->T128[] = array(2, 1);                       //107 : [END BAR]
    
        for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
            $this->ABCset .= chr($i);
        }
        $this->Aset = $this->ABCset;
        $this->Bset = $this->ABCset;
        
        for ($i = 0; $i <= 31; $i++) {
            $this->ABCset .= chr($i);
            $this->Aset .= chr($i);
        }
        for ($i = 96; $i <= 127; $i++) {
            $this->ABCset .= chr($i);
            $this->Bset .= chr($i);
        }
        for ($i = 200; $i <= 210; $i++) {                                           // controle 128
            $this->ABCset .= chr($i);
            $this->Aset .= chr($i);
            $this->Bset .= chr($i);
        }
        $this->Cset="0123456789".chr(206);
    
        for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
            @$this->SetFrom["A"] .= chr($i);
            @$this->SetFrom["B"] .= chr($i + 32);
            @$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
            @$this->SetTo["B"] .= chr($i);
        }
        for ($i=96; $i<107; $i++) {                                                 // contrôle des jeux A & B
            @$this->SetFrom["A"] .= chr($i + 104);
            @$this->SetFrom["B"] .= chr($i + 104);
            @$this->SetTo["A"] .= chr($i);
            @$this->SetTo["B"] .= chr($i);
        }
    }
    
    //________________ Fonction encodage et dessin du code 128 _____________________
    function Code128($x, $y, $code, $w, $h) {
        $Aguid = "";                                                                      // Création des guides de choix ABC
        $Bguid = "";
        $Cguid = "";
        for ($i=0; $i < strlen($code); $i++) {
            $needle = substr($code,$i,1);
            $Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
            $Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
            $Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
        }
    
        $SminiC = "OOOO";
        $IminiC = 4;
    
        $crypt = "";
        while ($code > "") {
                                                                                        // BOUCLE PRINCIPALE DE CODAGE
            $i = strpos($Cguid,$SminiC);                                                // forçage du jeu C, si possible
            if ($i!==false) {
                $Aguid [$i] = "N";
                $Bguid [$i] = "N";
            }
    
            if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
                $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
                $made = strpos($Cguid,"N");                                             // étendu du set C
                if ($made === false) {
                    $made = strlen($Cguid);
                }
                if (fmod($made,2)==1) {
                    $made--;                                                            // seulement un nombre pair
                }
                for ($i=0; $i < $made; $i += 2) {
                    $crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
                }
                $jeu = "C";
            } else {
                $madeA = strpos($Aguid,"N");                                            // étendu du set A
                if ($madeA === false) {
                    $madeA = strlen($Aguid);
                }
                $madeB = strpos($Bguid,"N");                                            // étendu du set B
                if ($madeB === false) {
                    $madeB = strlen($Bguid);
                }
                $made = (($madeA < $madeB) ? $madeB : $madeA );                         // étendu traitée
                $jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours
    
                $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap
    
                $crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu
    
            }
            $code = substr($code,$made);                                           // raccourcir légende et guides de la zone traitée
            $Aguid = substr($Aguid,$made);
            $Bguid = substr($Bguid,$made);
            $Cguid = substr($Cguid,$made);
        }                                                                          // FIN BOUCLE PRINCIPALE
    
        $check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
        for ($i=0; $i<strlen($crypt); $i++) {
            $check += (ord($crypt[$i]) * $i);
        }
        $check %= 103;
    
        $crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète
    
        $i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
        $modul = $w/$i;
    
        for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
            $c = $this->T128[ord($crypt[$i])];
            for ($j=0; $j<count($c); $j++) {
                $this->Rect($x,$y,$c[$j]*$modul,$h,"F");
                $x += ($c[$j++]+$c[$j])*$modul;
            }
        }
    }

    function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }

    function MultiCellWithMaxLineLength($w, $h, $text, $maxLineLength, $linea) {
        $lines = str_split($text, $maxLineLength);
        foreach ($lines as $line) {
            $this->MultiCell($w, $h, $line);
            $this->Ln($linea); // Altura de la línea que desees
        }
    }

}
$isMedicamentosEmpty = $database->infoDetalleConsulta($_POST['cita']);
foreach ($database->infoCliente($_POST['cliente']) as $consul) {
    $nombre = $consul['nombre'];
    $apellido = $consul['apellido'];
    $tarjetaSanitaria = $consul['TSI'];
    $dni = $consul['DNI'];
}
$pdf = new PDF();
if(!empty($isMedicamentosEmpty)){
// Primera página
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Image('assets/img/LOGO-B-N.png',10,12,25,0,'');
$pdf->Image('assets/img/generalitat.png',40,20,50,0,'');
$pdf->Ln(2);
$pdf->Cell(130);
$pdf->Cell(80,10, 'C/ Sant Mateu, 24-26');
$pdf->Ln(5);
$pdf->Cell(130);
$pdf->Cell(80,10, '08950 Esplugues del Llobregat,');
$pdf->Ln(5);
$pdf->Cell(130);
$pdf->Cell(80,10, 'Barcelona');
$pdf->Ln(5);
$pdf->Cell(130);
$pdf->Cell(80,10, 'contacto@clinicamontalban.com');
$pdf->Ln(22);
$pdf->Cell(3);
$pdf->SetFont('Arial','',13);
$txt = '<b>Plan de medicación                                                                                                              
</b>';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);
$pdf->SetLineWidth(0.45);
$pdf->Line(14,54.5,198,54.5);
$pdf->SetFont('Arial','',9);
$pdf->Ln(7.5);
$pdf->Cell(3);

$txt = $nombre.' '.$apellido;
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);
$pdf->Ln(7);
$pdf->Cell(3);
$pdf->Cell(0,0, $tarjetaSanitaria);
$pdf->Ln(-7.5);
$pdf->Cell(157);
$txt = 'Información';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);
$pdf->Ln(6);
$pdf->Cell(155);
$pdf->Cell(0,0, 'para la farmacia');

$code = $database->listarConsultaId($_POST['cita']);

$pdf->Code128(160,65,$code[0]['codigo_barras'],35,12);
$pdf->SetXY(57,40);
$pdf->Ln(37);
$pdf->Cell(150);
$pdf->SetFont('Arial','',8);
$pdf->Write(5,$code[0]['codigo_barras']);
$pdf->SetFont('Arial','',12);
$pdf->Ln(7);
$pdf->Cell(55);

$duracion = $database->listarConsultaId($_POST['cita']);

$txt = '<b>TRATAMIENTOS DE '.$duracion[0]['tipo_tratamiento'].' DURACIÓN</b>';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$pdf->Ln(6);
$pdf->Cell(4);
$pdf->SetFont('Arial','',8);

$txt = '<b>Medicamento o producto                            ';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$txt = 'Dosis y                            ';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$txt = 'Duración del                            ';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$pdf->Ln(3.5);
$pdf->Cell(4);
$txt = 'sanitario';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$pdf->Cell(43.5);
$txt = 'frecuencia';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$pdf->Cell(18.2);
$txt = 'tratamiento';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$pdf->Cell(16);
$txt = 'Vigencia                            ';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$txt = 'Comentarios</b>';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);

$pdf->SetLineWidth(0.30);
$pdf->Line(15,98.5,198,98.5);

$pdf->Ln(6);
$nivel=120;
$x=15.5;
$y=100;

foreach ($database->infoDetalleConsulta($_POST['cita']) as $consul) {
    $pdf->SetXY($x, $y); 
    $txt = $consul['nombre']." ".$consul['dosis_estandar'];
    $txt = utf8_decode($txt);
    $pdf->WriteHTML($txt);

    $pdf->SetXY(69, $y); 
    $txt = $consul['dosis'];
    $txt = utf8_decode($txt);
    $pdf->WriteHTML($txt);

    $pdf->SetXY(102, $y); 
    $txt = $consul['duracion'].' días';
    $txt = utf8_decode($txt);
    $pdf->WriteHTML($txt);

    $pdf->SetXY(132, $y); 
    $txt = 'del '.$consul['fecha_inicio'];
    $txt = utf8_decode($txt);
    $pdf->WriteHTML($txt);
    $pdf->SetXY(132, $y+3); 
    $txt = 'al '.$consul['fecha_fin'];
    $txt = utf8_decode($txt);
    $pdf->WriteHTML($txt);

    $maxLineLength = 20;
    $pdf->SetXY(167, $y); 
    $txt = $consul['obs'];
    $txt = utf8_decode($txt);
    $salto = $y;
    $lines = str_split($txt, $maxLineLength);
    foreach ($lines as $line) {
        $salto += 3.2;
        $pdf->MultiCell(0, 4, $line);
        $pdf->SetXY(167, $salto); 
    }
    //$pdf->WriteHTML($txt);

    $pdf->SetLineWidth(0.30);
    $pdf->Line(15,$nivel,198,$nivel);
    $nivel+=22;
    $pdf->Ln(22);
    $y+=22;
    if($y > 254){
        $pdf->AddPage();
        $y = 26;
        $nivel = 24.5;
        $pdf->Ln(6);
        $pdf->Cell(4);        

        $txt = '<b>Medicamento o producto                            ';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $txt = 'Dosis y                            ';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $txt = 'Duración del                            ';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $pdf->Ln(3.5);
        $pdf->Cell(4);
        $txt = 'sanitario';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $pdf->Cell(43.5);
        $txt = 'frecuencia';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $pdf->Cell(18.2);
        $txt = 'tratamiento';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $pdf->Cell(16);
        $txt = 'Vigencia                            ';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

        $txt = 'Comentarios</b>';
        $txt = utf8_decode($txt);
        $pdf->WriteHTML($txt);

    }
}

$citaDatos = $database->datosCita($_POST['cita']);

if(!empty($isMedicamentosEmpty)){
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Image('assets/img/LOGO-B-N.png',10,12,25,0,'');
$pdf->Image('assets/img/generalitat.png',40,20,50,0,'');
$pdf->Ln(2);
$pdf->Cell(130);
$pdf->Cell(80,10, 'C/ Sant Mateu, 24-26');
$pdf->Ln(5);
$pdf->Cell(130);
$pdf->Cell(80,10, '08950 Esplugues del Llobregat,');
$pdf->Ln(5);
$pdf->Cell(130);
$pdf->Cell(80,10, 'Barcelona');
$pdf->Ln(5);
$pdf->Cell(130);
$pdf->Cell(80,10, 'contacto@clinicamontalban.com');
$pdf->Ln(22);
$pdf->Cell(3);
$pdf->SetFont('Arial','',13);
$txt = '<b>Informe medico                                                                                                              
</b>';
$txt = utf8_decode($txt);
$pdf->WriteHTML($txt);
$pdf->SetLineWidth(0.45);
$pdf->Line(14,54.5,198,54.5);
$pdf->SetFont('Arial','',9);
$pdf->Ln(5.5);
$pdf->Cell(20);

$y = 50;
$maxLineLength = 70;
$pdf->SetXY(14, $y); 
$txt = $citaDatos[0]['informe'];
$txt = utf8_decode($txt);
//$pdf->WriteHTML($txt);

$salto = 50;
$lines = str_split($txt, $maxLineLength);
foreach ($lines as $line) {
    $salto += 3.2;
    $pdf->MultiCell(0, 16, $line);
    $pdf->SetXY(14, $salto); 
}

}
}
else{
    $citaDatos = $database->datosCita($_POST['cita']);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->Image('assets/img/LOGO-B-N.png',10,12,25,0,'');
    $pdf->Image('assets/img/generalitat.png',40,20,50,0,'');
    $pdf->Ln(2);
    $pdf->Cell(130);
    $pdf->Cell(80,10, 'C/ Sant Mateu, 24-26');
    $pdf->Ln(5);
    $pdf->Cell(130);
    $pdf->Cell(80,10, '08950 Esplugues del Llobregat,');
    $pdf->Ln(5);
    $pdf->Cell(130);
    $pdf->Cell(80,10, 'Barcelona');
    $pdf->Ln(5);
    $pdf->Cell(130);
    $pdf->Cell(80,10, 'contacto@clinicamontalban.com');
    $pdf->Ln(22);
    $pdf->Cell(3);
    $pdf->SetFont('Arial','',13);
    $txt = '<b>Informe medico                                                                                                              
    </b>';
    $txt = utf8_decode($txt);
    $pdf->WriteHTML($txt);
    $pdf->SetLineWidth(0.45);
    $pdf->Line(14,54.5,198,54.5);
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(5.5);
    $pdf->Cell(20);
    
    $y = 50;
    $maxLineLength = 70;
    $pdf->SetXY(14, $y); 
    $txt = $citaDatos[0]['informe'];
    $txt = utf8_decode($txt);
    //$pdf->WriteHTML($txt);
    
    $salto = 50;
    $lines = str_split($txt, $maxLineLength);
    foreach ($lines as $line) {
        $salto += 3.2;
        $pdf->MultiCell(0, 16, $line);
        $pdf->SetXY(14, $salto); 
    }
        
        
}
$apellidoTrim =str_replace(' ', '', $apellido);
$nombreDecode = utf8_decode($nombre);
$apellidoDecode = utf8_decode($apellidoTrim);

$pdf->SetLeftMargin(45);
$pdf->SetFontSize(14);
//$pdf->Output();
$pdf->Output($nombreDecode.$apellidoDecode."-".$citaDatos[0]['fecha']."-".$_POST['cita'].".pdf", 'D');
?>
