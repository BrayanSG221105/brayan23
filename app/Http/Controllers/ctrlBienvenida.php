<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ctrlBienvenida extends Controller
{
    public function Bienvenidos()
    {
        return view('Welcome');
    }
    public function Suma()
    {
        return(2+2);
    }
    public function DatosSuma($n1)
    {
        return("El numero que se recibio es: ".$n1);
        //Obtener los datos de la url 
    }
    public function SumaDatos($n1, $n2)
    {
        $datos=$n1+$n2;
        $resultado="El resultado de la suma es: ".$datos;
        return($resultado);
        //Obtener los datos de la url 
    }
    public function RetornoDatos($n1, $n2)
    { 
        $datos=$n1+$n2;
        $resultado="El resultado de la suma es: ".$datos;
        return view('welcome', compact('n1','n2','datos')); 
    }
}