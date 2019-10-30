<?php
/* IMPRIMIR POR PANTALLA */
echo "Hola"+"$variable";
print "Uno" . "dos";
var_dump($variable); //muestra info de variable

/* VARIABLES */
gettype($variable); //devuelve tipo de variable
is_array($var);
///is_bool(), is_float(), is_integer(), is_null(), is_numeric(), is_object(), is_resource(), is_scalar(), is_string();
//comprueba si es de ese tipo

/* CONVERSIONES */
(int) $variable; //convierte
//(real), (double), (float), (string), (array), (object)

/* ÁMBITO */
//locales -> definidas dentro de función solo accesibles dentro
//dentro de funcion -> si dos variables con mismo nombre, utiliza local
//globales -> fuera de funciones o $_GLOBALS['var']

/* CONSTANTE */
define('CONSTANTE', 'VALOR_CONSTANTE');
//boolean, integer, double, string

/* MATRICES SUPERGLOBALES */
$GLOBALS; //$_COOKIE, $_ENV, $_FILES, $_GET, $_POST, $_REQUEST, $_SERVER, $_SESSION;

/* OPERADOR TERNARIO */
condicion ? exp1 : exp2;

/* INCLUIR ARCHIVO */
require 'direccion'; // si no lo encuentra muestra error
require_once 'dir';
include 'dir'; // si no lo encuentra muestra advertencia
include_once 'dir';

/* ESTRUCTURAS DE CONTROL */
if (condition) {
    # code...
} else if (condition) {
    # code...
} else {
    # code...
}

switch ($variable) {
    case 'value':
        # code...
        break;

    default:
        # code...
        break;
}

/* ESTRUCTURAS REPETITIVAS */
for ($i = 0; $i < count($array); $i++) {
    # code...
}
foreach ($variable as $key => $value) {
    # code...
}
foreach ($variable as $value) {
    # code...
}

/* ARRAYS */
$arrayName = array(2 => "dos", "tres", 7 => "siete"); //al no poner nada, da como clave el siguiente
$array[2] = "siete"; //se puede hacer directamente así y no hace falta seguir orden de claves
unset($array[2]); //elimina posición
unset($array); //elimina array
print_r($arrayName); //imprime array entero. no se puede utilizar con echo. solo útll en debug
$array = array(1, 1, 1, 1, 1, 8 => 1, 4 => 1, 19, 3 => 13); //3 i 4 de despres xafen l'antic. el 19 estara en la posició 9 (seguent al 8)
count($array); //longitud del array. también sizeof()
key($array); //indice del array en la posición actual
array_pop($array); //saca ultimo elemento array
array_push($array, $valor1, $valor2); //introduce valores en array
implode($delimitador, $array); //devuelve string de array separada por delimitador
explode($delimitador, $string); //convierte en array

/* CADENAS */
str_replace($original, $nueva, $string); //devuelve string reemplazando original por nueva
trim($string); //elimina caracteres a los lados (espacios, saltos de línea)
strtolower($str); //también strtoupper();
ucfirst($str); //primera en mayuscula
htmlspecialchars($str); //evitar inyección javascript
//para evitar inyecciones
htmlspecialchars(trim($entrada));

/* FUNCIONES */
function FunctionName($valor, &$referencia)
{
    /* por defecto la pasa por valor */
    /* con & la pasa por referencia */
    return true;
}

/* function() {
// función anónima
return true;
} */

/* FORMULARIOS */
//GET pasa por url?clave=valor&clave2=valor2
$valor = $_GET['clave'];
//si se quiere pasar en url sin errores
echo '<a href="localhost?clave=' . urlencode($valor) . '"></a>';

//POST
//permite pasar binarios si se utiliza enctype="multipart/form-data"
$_POST['name']; //name coincide con name de input

//FICHEROS
//array con nombre del input file y datos
$_FILES['name']['name']; //nombre del fichero que se ha subido
$_FILES['name']['type']; //tipo mime
$_FILES['name']['size']; //tamaño. php.ini restringe tamaño de subida
$_FILES['name']['tmp_name']; //al subirlo se almacena en carpeta temporal con ese nombre
$_FILES['name']['error']; //código de error si lo hay
//procedimiento
/*
1. Se comprueba si se ha subido correctamente con is_uploaded_file($_FILES['fichero']['tmp_name'])
2. Dar nombre al fichero
3. Moverlo con move_uploaded_file($_FILES['fichero']['tmp_name'], $direccionCompletaConNombreYExtensión);
 */

/* POO */
class NombreClase
{
    private $atributo; //atributo del objeto
    private static $estatico; //atributo estático (de la clase)

    //estático significa que no es necesario tener un objeto de esa clase para poder utilizarlo
    //el atributo del objeto caracteriza al objeto y el estático a toda la case. por ejemplo, puedo tener una clase clientes con un atributo dni y un atributo estático numClientes. en el constructor diré que de valor al dni y sume 1 al numClientes. si tengo varios clientes, cada uno tendrá su dni pero todos compartirán el numClientes porque su valor está compartido por toda la clase

    public function __construct($atributo)
    {
        //método mágico constructor
        $this->atributo = $atributo; //cuidado con no poner más $ de los necesarios
    }

    public function __get($atributo)
    {
        if (property_exists(__CLASS__, $atributo)) {
            return $this->$atributo;
        }
        // devuelve el atributo con el nombre $atributo si existe. CUIDADO, haría todos los atributos accesibles directamente desde fuera
        //para utilizarlo, $objeto->atributo;
    }

    public function __set($atributo, $valor)
    {
        if (property_exists(__CLASS__, $atributo)) {
            $this->$atributo = $valor;
        }
        //cambia valor de atributo a $valor
        //para utilizarlo, $objeto->atributo = $valor;
    }

    public function __toString()
    {
        //se ejecuta al hacer un echo del objeto
        return var_dump($this);
    }

    public static function nombre()
    {
        // cuando llamamos a una función de una clase, la llamamos con $objeto->funcion();
        // para llamar una función estática utilizamos NombreClase::funcion();
        // no es necesario crear un objeto para llamar a una función estática
        // muy útil cuando, por ejemplo, queremos obtener todos los clientes. En vez de crear un objeto cliente, utilizamos Cliente::obtenerTodos() y luego utilizamos los datos recogidos para crear los clientes que necesitemos
        //si queremos utilizar esta función dentro de la clase, en lugar de utilizar $this->nombre() deberemos utilizar self::nombre()
    }
}
//HERENCIA
// se utiliza extends Padre después de NombreClase
// atributos deberán ser protected en vez de private
// en constructor se debe llamar a parent::__construct(atributos del padre) y luego utilizar los del hijo

/* BASES DE DATOS */
//lo más útil es crear una clase Conexion

class Conexion
{
    private $conexion;

    public function __construct($servidor, $usuario, $clave, $baseDatos)
    {
        $conexion = mysqli_connect($servidor, $usuario, $clave, $baseDatos);
        if ($conexion->connect_errno) {
            echo 'Error al conectar.';
            return null;
        } else {
            $conexion->set_charset('utf-8');
            return $conexion;
        }
    }

    public function obtenerConexion()
    {
        return $conexion;
    }

    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}

//para utilizarla:
$conexion = new Conexion($servidor, $usuario, $clave, $baseDatos);
if (isset($conexion)) {
    //si hubiera error, sería null y no entraría

    //ejemplo de select
    $resultado = $conexion->query("SELECT * FROM tabla"); //ejecuta consulta y recoge datos en un objeto mysqli_result
    echo $resultado->num_rows; //escribe el número de filas que se han obtenido
    while ($fila = $resultado->fetch_assoc()) {
        //guarda en un array asociativo la información de la siguiente fila. cuando no queden filas, será null y no entrará
        echo $fila['clave']; //la clave es el nombre de la columna de la base de datos
    }

    //ejemplo de insert, update o delete
    if (!$conexion->query("UPDATE tabla SET clave = valor")) {
        // cuando query tiene un error devuelve false
        echo 'Error';
    }

    $conexion->close(); //cierra la conexión cuando se termine de utilizarla
}

/* SESIONES */
// las sesiones permiten almacenar datos para usuarios de manera individual
$_SESSION['clave'] = $valor; // array global para almacenar información
session_start(); // inicia o restaura la sesión del cliente. sin una sesión iniciada no se puede utilizar $_SESSION
session_destroy(); // elimina el array $_SESSION y cierra sesión
