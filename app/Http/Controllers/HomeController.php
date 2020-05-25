<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;

use App\item;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function printTest()
    {
        /* Fill in your own connector here */
//$connector = new FilePrintConnector("php://stdout");
        $connector = new DummyPrintConnector();

/* Start the printer */
//$logo = EscposImage::load("resources/escpos-php.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
//$printer -> graphics($logo);
    $tux = EscposImage::load("resources/olivoalcazar.png", false);
    
    $printer -> bitImage($tux, Printer::IMG_DEFAULT);
    $printer -> feed();
    $items = array(
    new item("Example item #1", "4.00"),
    new item("Another thing", "3.50"),
    new item("Something else", "1.00"),
    new item("A final item", "4.45"),
);
foreach ($items as $item) {
    $printer -> text($item);
}
/*$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("Olivo AlCazar\n");
$printer -> selectPrintMode();*/
//$printer -> text($tax);
/*$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Item 1 .\n");

$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("200kg.\n");*/
//$printer -> text("________________________________\n");
//$printer -> cut();
/*$printer -> selectPrintMode();
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Item 1 .\n");
$printer -> selectPrintMode();
$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("200kg.\n");*/
$printer -> text("--------------------------------\n");
/* QR Code - see also the more in-depth demo at qr-code.php */

// Most simple example
//title($printer, "QR code demo\n");
$testStr = "http://192.168.1.111:8000/testPrint";
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> qrCode($testStr, Printer::QR_ECLEVEL_L, 5);
$printer -> feed();
$printer -> text("Pixel size 3 \n");
$printer -> feed();
/*$printer -> selectPrintMode();
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Item 1 .\n");
$printer -> selectPrintMode();
$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("200kg.\n");
$printer -> cut();
*/
$printer -> feed();

/* Cut the receipt and open the cash drawer */
$printer -> cut();
// send to app
echo "base64,".base64_encode($connector -> getData());
$printer -> pulse();

$printer -> close();

//$connector->finalize();
    }


}


