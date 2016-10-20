<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/libraries/FPDF/fpdf.php";

class PDF extends FPDF{

	private $dias=array();
	private $meses=array();

  var $widths;
  var $aligns;

	function __construct(){

		parent::__construct();	
        
		setlocale(LC_ALL,"es_ES");
		$this->dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$this->meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	}
        // El encabezado del PDF
    public function Header(){

            $logo = str_replace('admin/','',FCPATH).'static/images/logo_uptx_500x230.png';
            $this->cell(35,16,$this->Image($logo,15,13,25,10),1,0,'C');
            $this->SetFont('Times','B',10);
            $this->Cell(120,10,"Formato:\n",'L T R','J',false);
            $this->SetFont('Times','B',8);
            $this->MultiCell(35,4,utf8_decode("Código: CC-F-08-3\nFecha: Abril de 2015\nRev. 4\nPág. ".$this->PageNo()." de {nb}"),1,'L',false);
            $this->SetFont('Times','B',12);
            $this->Ln(-10);
            $this->Cell(35,10);
            $this->Cell(120,10,utf8_decode('Informe de auditoría de servicios'),'L R B',0,'C');
            $this->Ln(15);
    }
       // El pie del pdf
    public function Footer(){

        $this->SetY(-10);
        $this->SetFont('Times','B',8);
        $this->SetFillColor(224,235,255);
        $this->Cell(190,5,utf8_decode('Documento controlado por medios electrónicos. Para uso exclusivo de la dependencia responsable o autoridad correspondiente'),10,10,'C',true);
    }

    // FUNCINES DE CELDAS \\

    function SetWidths($w){
      //Set the array of column widths
      $this->widths=$w;
    }

    function SetAligns($a){
      //Set the array of column alignments
      $this->aligns=$a;
    }

    function Row($data){
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            //$this->MultiCell($w,5,$data[$i],0,$a);
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h){
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function CheckPageLine(){
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY() > ($this->PageBreakTrigger/2-30))
            $this->AddPage($this->CurOrientation);
    }


    function NbLines($w,$txt){
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }


}

