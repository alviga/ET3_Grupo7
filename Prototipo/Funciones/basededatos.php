<?php
class Create_database
{	
  protected $pdo;

	public function __construct(){
		$this->pdo = new PDO("mysql:host=127.0.0.1;","root","iu");
	}
	//creamos la base de datos y las tablas que necesitemos
	public function my_db()	{
        //creamos la base de datos si no existe
	$crear_db = $this->pdo->prepare('CREATE DATABASE IF NOT EXISTS iu2 '); 
	$crear_db->execute();
		
	//decimos que queremos usar la base de datos que acabamos de crear	
  if($crear_db):
		$use_db = $this->pdo->prepare('USE  iu2');
    $use_db->execute();
		endif;
		
	//si se ha creado la base de datos y estamos en uso de ella creamos las tablas
		if($use_db):
		//creamos las tablas
		$crear_tb= $this->pdo->prepare('
		

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iu2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `NOMBREACCION` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`NOMBREACCION`, `DESCRIPCION`) VALUES
(\'Alta\', \'Permite Crear acciones\'),
(\'Baja\', \'Posibilidad de Eliminar\'),
(\'Consultar\', \'Permite Consultar \'),
(\'Modificar\', \'Posibilidad de Modificar\'),
(\'Ver en Detalle\', \'Posibilidad de Ver en Detalle\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `NOMBRE` varchar(20) NOT NULL,
  `CATEGORIA` varchar(40) NOT NULL,
  `ESPACIO` int(3) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `DESCRIPCION` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`NOMBRE`, `CATEGORIA`, `ESPACIO`, `USUARIO`, `DESCRIPCION`) VALUES
(\'fitnes\', \'aerobic\', 1, 3, \'aerobic\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ID` int(3) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `NACIMIENTO` date DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(45) DEFAULT NULL,
  `EMAIL` varchar(45) DEFAULT NULL,
  `FOTO` varchar(100) DEFAULT NULL,
  `CUENTABANCARIA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ID`, `NOMBRE`, `APELLIDOS`, `NACIMIENTO`, `DIRECCION`, `TELEFONO`, `EMAIL`, `FOTO`, `CUENTABANCARIA`) VALUES
(1, \'pedro\', \'pedrazo\', \'2016-11-01\', \'a.v. santiago\', \'666666666\', \'lumenocaño\', NULL, \'2190293291293492492374\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `ID` int(11) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `ALUMNO` int(3) NOT NULL,
  `ACTIVIDAD` varchar(20) NOT NULL,
  `INICIO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FIN` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `ID` int(3) NOT NULL,
  `USUARIOID` int(3) NOT NULL,
  `TOTALEFECTIVO` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`ID`, `USUARIOID`, `TOTALEFECTIVO`) VALUES
(1, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_actividad`
--

CREATE TABLE `categoria_actividad` (
  `NOMBRE` varchar(40) NOT NULL,
  `DESCRIPCION` varchar(40) NOT NULL,
  `DESCUENTO` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_actividad`
--

INSERT INTO `categoria_actividad` (`NOMBRE`, `DESCRIPCION`, `DESCUENTO`) VALUES
(\'aerobic\', \'aerobic\', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `NIF` int(20) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `TELEFONO` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`NIF`, `NOMBRE`, `TELEFONO`) VALUES
(222223345, \'MUEBLES PACO\', 555555555);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultafisio`
--

CREATE TABLE `consultafisio` (
  `ID` int(11) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `INICIO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FIN` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\',
  `ALUMNO` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultafisio`
--

INSERT INTO `consultafisio` (`ID`, `USUARIO`, `INICIO`, `FIN`, `ALUMNO`) VALUES
(1, 3, \'2016-11-17 23:00:00\', \'2016-11-18 23:00:00\', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `ID` int(2) NOT NULL,
  `CANTIDAD` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`ID`, `CANTIDAD`) VALUES
(30, 0);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DOCUMENTO` blob NOT NULL,
  `IDUSUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `DNI` varchar(9) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDO` varchar(40) NOT NULL,
  `NACIMIENTO` date NOT NULL,
  `DIRECCION` varchar(40) NOT NULL,
  `TELEFONO` int(9) NOT NULL,
  `FOTO` blob NOT NULL,
  `EMAIL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`DNI`, `NOMBRE`, `APELLIDO`, `NACIMIENTO`, `DIRECCION`, `TELEFONO`, `FOTO`, `EMAIL`) VALUES
(\'44490838Y\', \'PEPE\', \'PEPITO\', \'2016-11-01\', \'CALLE PENEIRA\', 777777777, 0xffd8ffe000104a46494600010100000100010000ffdb008400090607080706090807080a0a090b0d160f0d0c0c0d1b14151016201d2222201d1f1f2428342c242631271f1f2d3d2d3135373a3a3a232b3f443f384334393a37010a0a0a0d0c0d1a0f0f1a37251f253737373737373737373737373737373737373737373737373737373737373737373737373737373737373737373737373737ffc00011080080007403012200021101031101ffc4001b00000105010100000000000000000000000200010304050607ffc4003210000202010303020502060203000000000102000311041221053141135106226171911481233242a1d1f0c1e11562b1ffc4001801010003010000000000000000000000000002030401ffc4001e11010101000203010101000000000000000001021121031231412204ffda000c03010002110311003f00f3baada7d315d94e70b92e3b93bb3f8c7108369458c76586bd9c0cf3bbfdc4ac0420206868b55a4abd7aeed2a5b53be53720dc06cb0637771f31acf07c1967d5e8835166dd3eac50da6f4c670ccb69eefc9f031c7bcc90217d206d35df0eee7dba4d6636bed01ffab8dbceef7cfdff00119eee81b31569754497ee5bb0c9f3bbd8ff0061998e042c401507033df1cc4703b986d855c9ec257bc82fb58f6ec2475ae13ce7d86ac1b383dbbc7953e6aec5719c16e40f697488cde4de7d6848804490c6224904460c918403000c50b11a01886202c90080f0808c218101010a211f10333a8eacadf5515e33b816ff0012cd9512a6caf048e0827393992f4dd1d3a8d6b9b2b0ff0036799db7fe2f4b7683f4e94a544f21950641946f5db578b3d381d3ee4ddea0f95b207d258a896419ee3896f59a66a6db2abc05b2bcf03ffa2564181c762733b8bda3e59fc98c1c49088065cce0680d2480c200468f140258620ac380421880b2480e3bc7619531086071007e195badd43d60a86d9bc11ce3c7336ba1ebfaabeb5eaba9ada8adf6fa8d6107f61e6667c3960d2f51b2ad80b5985c938c7733a7d3d1fa7b59940e4e666ddbcb6f8e4f588baf686870dadb1199914285507272471c7de73dd456a5d53ad358ad401951e0e399d56a6e3e838563b950b67f69c6913be19fa879ef5c020110cc669a1951c06866018006347314025870161c035872359240310c76918863b408ac4a57574df7322a93b58b76fa4d93d63495e28d25cb67fec1be51397ea7a8aaf2a8ac58a1f1d842d2d15d75d240c25e42b263d8fe655bccbf5a3c7abc70eaf51afd2d3a3b905c2cb9eb230bf377e33f93315a682be9291b6b15a718ec3333ed28af8dea73f58f1d91cf2cd5ec07b4168460b4b54236810cc08026288c538e92c312359209d706b0c48c430788002d66b3657800672c44abac7dca17d47624f03b0fc47775ab4ac771dcc4631dcf320d3e9afaff008d7aedafb8e7c4876b78905550c790b81f69a9a756ca1639dbdb3e24697699571bece7b0283995eeb6ea905c847a67f9411de46cb564d663a0446b172c10fdc467d069ad18b29ac9efdbfc4c5d2f537761b9b0bf6389d0682daafc856dccaa09c11cfd25773627ef9a1b7a2afa94352e426dd96367700c0023bfb86fed28eb744d46e5feb4386c7f291ee3fc4dfd4f50d0e83a628bad01acb7763e817fecccbaecfd4eb806b43a587f9b6e3fa70067eb278b6abde64e98b01a4b62051bd0e6a62769c7b783f51216973384c518c50e909209142061c4b1cb614fda0a98d61c21fa8812fc3ca2cea8ca450cea80d6350fb53bf3cfda763afafa77c41aaab41a4a4ad29bfd5d4a2614fb007ea41e7e98f33807b1b4b62588c41e01c4d1afaf5f6605975ad60f3fcbfdc4872bbd7f1a1aef879ab63516a54875c2a8c0c67b82ddf3c93dfdbeb28f52d11f50a035ee055b0ab95ce307cc5b6cd537ab63b16f2598938fbc009ab4b55f437ba32f83f303fb1cc8cd476f8efe2ee83a0dc357a6aadac8aedb7790c00d88b86271e32481cfbcd4e85d369ea5f11dda7d05ad7ad5616f5e961e98ace3be796e49071f7cf1cd07f883abdf5ad7abbaca082725100460463071dc7de6a74bead569ff0053a834b7ea069bd1a8d636d629dc33585c60783f98bae5299e239eea5a7dd69de4bd7558c8ade180c899da5bdf496b69ac6cd6d8da49f6edf89bbd735280fe86aad6b4a6c63c79cf6fc64cc4be95b40c9c303907da4b33a55bbdb6b4d4259a6d5d9a86f4f4c08b4bf8527bff00c7e2656a2b7a2d6adf1b97d8fee21687a80a11e8ea16595d24efd9513f391e73fb0e2524b6ed5ded70467f51c0e324933b3aae6b8bf12c68c62924084291830c40306339c955fac6cc024870defda7349e27355f559b6e545ee580fb472be9d991dc19369d7f8aec7c711af5fe219193a4b57fa6e74dafd4a4f938967455e588c7995ba2b85bf69edc4d6a13d2d511e0994dfad33e2cd5a75c72a206a92b546f517e40b9399a65542670264f5f2574161f0401fde424ee476de25ae62eb5aeb0bbbb31ec0b1c9c7812126226093363020b95b5372d09c8cf389da746d1274ae9d66aad397151e4f2700769cb743a8dbad2f8eeddff0079d1fc4fac15682bd2567e6b0f3f61fe894eadbae23466499e5cae628198a5aa0c0c31238e0ceb89332c3d18a91f1c012b261980f7334b5ec2ad02af963812bdfd5de2ea5accd39f949f7262b7e6b001f684a02a01e046d3a96b431f064af5109de9a5a33b758a3b7027456839aad982956ebeb71dc19d16b1d29e8d65f6e71500d9033c4a34d5969d78b2999fd574e755a1b295386238fb896f40dead63d339c8ce47981a94656e643b95deaf4e05b2a4ab0c1070646e70a48f026b7c4542d360d40f955d82b9f03eb33bf4e1d883727a780721b9efce26acea58c9ac5945f0f6a2ddabb0271ef0facea5b51ae72dfd20281edfe9cc9fd1af41a5165698565565e79c9ee265331662c4f27bc86673ab5abfd1e99f16733e9451a296b13fffd9, \'TODOFUEGO.COM\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacio`
--

CREATE TABLE `espacio` (
  `ID` int(11) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `INICIO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FIN` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\',
  `DISPONIBILIDAD` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `espacio`
--

INSERT INTO `espacio` (`ID`, `USUARIO`, `INICIO`, `FIN`, `DISPONIBILIDAD`) VALUES
(1, 3, \'2016-11-17 23:00:00\', \'2016-11-18 23:00:00\', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(40) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `ESPACIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`ID`, `NOMBRE`, `USUARIO`, `ESPACIO`) VALUES
(1, \'CONCIERTO FLAUTA\', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID` int(11) NOT NULL,
  `IDLINEA` int(3) NOT NULL,
  `PAGADO` tinyint(1) NOT NULL,
  `PRECIO_INSCRIPCION` int(11) DEFAULT NULL,
  `PRECIO_FISIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`ID`, `IDLINEA`, `PAGADO`, `PRECIO_INSCRIPCION`, `PRECIO_FISIO`) VALUES
(1, 1, 0, 50, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionalidades`
--

CREATE TABLE `funcionalidades` (
  `NOMBRE_FUNCIONALIDAD` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(240) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `funcionalidades`
--

INSERT INTO `funcionalidades` (`NOMBRE_FUNCIONALIDAD`, `DESCRIPCION`) VALUES
(\'Gestion de Acciones\', \'Gestion de Acciones\'),
(\'Gestion de Funcionalidades\', \'Gestion de Funcionalidades\'),
(\'Gestion de Grupos\', \'Gestion de Grupos\'),
(\'Gestion de Usuarios\', \'Gestion de Usuarios\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fun_accion`
--

CREATE TABLE `fun_accion` (
  `NOMBRE_FUNCIONALIDADES` varchar(45) NOT NULL,
  `NOMBRE_ACCIONES` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fun_accion`
--

INSERT INTO `fun_accion` (`NOMBRE_FUNCIONALIDADES`, `NOMBRE_ACCIONES`) VALUES
(\'Gestion de Funcionalidades\', \'Alta\'),
(\'Gestion de Funcionalidades\', \'Baja\'),
(\'Gestion de Funcionalidades\', \'Consultar\'),
(\'Gestion de Funcionalidades\', \'Modificar\'),
(\'Gestion de Funcionalidades\', \'Ver en Detalle\'),
(\'Gestion de Acciones\', \'Alta\'),
(\'Gestion de Acciones\', \'Baja\'),
(\'Gestion de Acciones\', \'Consultar\'),
(\'Gestion de Acciones\', \'Modificar\'),
(\'Gestion de Acciones\', \'Ver en Detalle\'),
(\'Gestion de Grupos\', \'Alta\'),
(\'Gestion de Grupos\', \'Baja\'),
(\'Gestion de Grupos\', \'Consultar\'),
(\'Gestion de Grupos\', \'Modificar\'),
(\'Gestion de Grupos\', \'Ver en Detalle\'),
(\'Gestion de Usuarios\', \'Alta\'),
(\'Gestion de Usuarios\', \'Baja\'),
(\'Gestion de Usuarios\', \'Consultar\'),
(\'Gestion de Usuarios\', \'Modificar\'),
(\'Gestion de Usuarios\', \'Ver en Detalle\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fun_grupo`
--

CREATE TABLE `fun_grupo` (
  `NOMBRE_FUNCIONALIDAD` varchar(45) NOT NULL,
  `NOMBRE_GRUPO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fun_grupo`
--

INSERT INTO `fun_grupo` (`NOMBRE_FUNCIONALIDAD`, `NOMBRE_GRUPO`) VALUES
(\'Gestion de Acciones\', \'ADMIN\'),
(\'Gestion de Acciones\', \'monitores\'),
(\'Gestion de Funcionalidades\', \'ADMIN\'),
(\'Gestion de Funcionalidades\', \'monitores\'),
(\'Gestion de Grupos\', \'ADMIN\'),
(\'Gestion de Grupos\', \'monitores\'),
(\'Gestion de Usuarios\', \'ADMIN\'),
(\'Gestion de Usuarios\', \'monitores\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `ID` int(11) NOT NULL,
  `CANTIDAD` varchar(10) NOT NULL,
  `FECHA` date NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `SERVICIO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`ID`, `CANTIDAD`, `FECHA`, `USUARIO`, `SERVICIO`) VALUES
(1, \'50\', \'2016-11-18\', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `NOMBRE_GRUPO` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(240) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`NOMBRE_GRUPO`, `DESCRIPCION`) VALUES
(\'ADMIN\', \'43242423\'),
(\'monitores\', \'1232131\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `ID` int(11) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `ALUMNO` int(3) NOT NULL,
  `ACTIVIDAD` varchar(20) DEFAULT NULL,
  `EVENTO` int(3) DEFAULT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FORMA_PAGO` varchar(40) NOT NULL,
  `TIEMPO_PAGO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`ID`, `USUARIO`, `ALUMNO`, `ACTIVIDAD`, `EVENTO`, `FECHA`, `FORMA_PAGO`, `TIEMPO_PAGO`) VALUES
(1, 3, 1, \'fitnes\', 1, \'2016-11-17 23:00:00\', \'EFECTIVO\', \'MENSUAL\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lesion`
--

CREATE TABLE `lesion` (
  `ID` int(11) NOT NULL,
  `EMPLEADO` varchar(9) DEFAULT NULL,
  `ALUMNO` int(3) DEFAULT NULL,
  `DESCRIPCION` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lesion`
--

INSERT INTO `lesion` (`ID`, `EMPLEADO`, `ALUMNO`, `DESCRIPCION`) VALUES
(1, \'44490838Y\', NULL, \'ROTURA DE TABIQUE\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_factura`
--

CREATE TABLE `linea_factura` (
  `ID` int(11) NOT NULL,
  `CANTIDAD` int(6) NOT NULL,
  `USUARIO` int(3) NOT NULL,
  `INSCRIPCION` int(3) DEFAULT NULL,
  `FISIO` int(3) DEFAULT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DESCUENTO` int(3) NOT NULL,
  `TIEMPO_PAGO` varchar(20) NOT NULL,
  `FORMA_PAGO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea_factura`
--

INSERT INTO `linea_factura` (`ID`, `CANTIDAD`, `USUARIO`, `INSCRIPCION`, `FISIO`, `FECHA`, `DESCUENTO`, `TIEMPO_PAGO`, `FORMA_PAGO`) VALUES
(1, 50, 3, 1, NULL, \'2016-11-17 23:00:00\', 30, \'MENSUAL\', \'EFECTIVO\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `not-alum`
--

CREATE TABLE `not-alum` (
  `IDNOT` int(11) NOT NULL,
  `IDALUM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `not-alum`
--

INSERT INTO `not-alum` (`IDNOT`, `IDALUM`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `not-usu`
--

CREATE TABLE `not-usu` (
  `IDNOT` int(11) NOT NULL,
  `IDUSU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `not-usu`
--

INSERT INTO `not-usu` (`IDNOT`, `IDUSU`) VALUES
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `ID` int(11) NOT NULL,
  `USUARIO` int(3) DEFAULT NULL,
  `COMENTARIO` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`ID`, `USUARIO`, `COMENTARIO`) VALUES
(3, 3, \'bienvenidos\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `ID` int(11) NOT NULL,
  `CLIENTE` int(3) NOT NULL,
  `DESCRIPCION` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`ID`, `CLIENTE`, `DESCRIPCION`) VALUES
(1, 222223345, \'COLOCACION DE MUEBLES DE BAÃ‘O\');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `USUARIO` varchar(40) NOT NULL,
  `PASSWORD` varchar(128) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `APELLIDOS` varchar(100) DEFAULT NULL,
  `DNI` varchar(45) DEFAULT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `FOTO` varchar(100) DEFAULT NULL,
  `CODIGOPOSTAL` int(11) DEFAULT NULL,
  `DESCRIPCION` varchar(100) DEFAULT NULL,
  `CUENTABANCARIA` varchar(100) DEFAULT NULL,
  `GRUPO_NOMBRE_GRUPO` varchar(45) DEFAULT NULL,
  `FechaNac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `USUARIO`, `PASSWORD`, `NOMBRE`, `APELLIDOS`, `DNI`, `EMAIL`, `FOTO`, `CODIGOPOSTAL`, `DESCRIPCION`, `CUENTABANCARIA`, `GRUPO_NOMBRE_GRUPO`, `FechaNac`) VALUES
(3, \'ADMIN\', \'73acd9a5972130b75066c82595a1fae3\', \'Pablo\', \'Gonzalez Rodriguez\', \'39476158B\', \'pablopeiboll@gmail.com\', \'images.jpg\', 36214, \'Este usuario es administrador\', \'32313131\', \'ADMIN\', \'2016-11-02\');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`NOMBREACCION`);

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`NOMBRE`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`),
  ADD KEY `ESPACIO` (`ESPACIO`),
  ADD KEY `INSTRUCTOR` (`USUARIO`),
  ADD KEY `CATEGORIA` (`CATEGORIA`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CUENTABANCARIA` (`CUENTABANCARIA`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `ACTIVIDAD` (`ACTIVIDAD`),
  ADD KEY `INICIO` (`INICIO`),
  ADD KEY `FIN` (`FIN`),
  ADD KEY `ALUMNO` (`ALUMNO`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIOID` (`USUARIOID`);

--
-- Indices de la tabla `categoria_actividad`
--
ALTER TABLE `categoria_actividad`
  ADD PRIMARY KEY (`NOMBRE`),
  ADD KEY `DESCUENTO` (`DESCUENTO`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`NIF`);

--
-- Indices de la tabla `consultafisio`
--
ALTER TABLE `consultafisio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `ALUMNO` (`ALUMNO`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CANTIDAD` (`CANTIDAD`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`),
  ADD KEY `IDUSUARIO_2` (`IDUSUARIO`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `DNI` (`DNI`);

--
-- Indices de la tabla `espacio`
--
ALTER TABLE `espacio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `INICIO` (`INICIO`),
  ADD KEY `FIN` (`FIN`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `ESPACIO` (`ESPACIO`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PAGO` (`IDLINEA`),
  ADD KEY `FECHA` (`PAGADO`);

--
-- Indices de la tabla `funcionalidades`
--
ALTER TABLE `funcionalidades`
  ADD PRIMARY KEY (`NOMBRE_FUNCIONALIDAD`);

--
-- Indices de la tabla `fun_grupo`
--
ALTER TABLE `fun_grupo`
  ADD PRIMARY KEY (`NOMBRE_FUNCIONALIDAD`,`NOMBRE_GRUPO`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SERVICIO` (`SERVICIO`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`NOMBRE_GRUPO`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `ALUMNO` (`ALUMNO`),
  ADD KEY `ACTIVIDAD` (`ACTIVIDAD`),
  ADD KEY `EVENTO` (`EVENTO`),
  ADD KEY `TIEMPO_PAGO` (`TIEMPO_PAGO`),
  ADD KEY `FORMA_PAGO` (`FORMA_PAGO`);

--
-- Indices de la tabla `lesion`
--
ALTER TABLE `lesion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EMPLEADO` (`EMPLEADO`),
  ADD KEY `ALUMNO` (`ALUMNO`);

--
-- Indices de la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `INSCRIPCION` (`INSCRIPCION`),
  ADD KEY `FISIO` (`FISIO`),
  ADD KEY `DESCUENTO` (`DESCUENTO`),
  ADD KEY `FECHA` (`FECHA`),
  ADD KEY `FORMA_PAGO` (`FORMA_PAGO`),
  ADD KEY `TIEMPO_PAGO` (`TIEMPO_PAGO`);

--
-- Indices de la tabla `not-alum`
--
ALTER TABLE `not-alum`
  ADD UNIQUE KEY `IDNOT_4` (`IDNOT`),
  ADD UNIQUE KEY `IDALUM_3` (`IDALUM`),
  ADD KEY `IDNOT` (`IDNOT`),
  ADD KEY `IDALUM` (`IDALUM`),
  ADD KEY `IDNOT_2` (`IDNOT`),
  ADD KEY `IDNOT_3` (`IDNOT`),
  ADD KEY `IDALUM_2` (`IDALUM`);

--
-- Indices de la tabla `not-usu`
--
ALTER TABLE `not-usu`
  ADD KEY `IDNOT` (`IDNOT`),
  ADD KEY `IDUSU` (`IDUSU`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLIENTE` (`CLIENTE`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`),
  ADD KEY `DNI` (`DNI`),
  ADD KEY `ROL` (`GRUPO_NOMBRE_GRUPO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `consultafisio`
--
ALTER TABLE `consultafisio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `espacio`
--
ALTER TABLE `espacio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `lesion`
--
ALTER TABLE `lesion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`ESPACIO`) REFERENCES `espacio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_4` FOREIGN KEY (`CATEGORIA`) REFERENCES `categoria_actividad` (`NOMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`ACTIVIDAD`) REFERENCES `inscripcion` (`ACTIVIDAD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_3` FOREIGN KEY (`ALUMNO`) REFERENCES `inscripcion` (`ALUMNO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`USUARIOID`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categoria_actividad`
--
ALTER TABLE `categoria_actividad`
  ADD CONSTRAINT `categoria_actividad_ibfk_1` FOREIGN KEY (`DESCUENTO`) REFERENCES `descuento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consultafisio`
--
ALTER TABLE `consultafisio`
  ADD CONSTRAINT `consultafisio_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultafisio_ibfk_2` FOREIGN KEY (`ALUMNO`) REFERENCES `alumno` (`ID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `espacio`
--
ALTER TABLE `espacio`
  ADD CONSTRAINT `espacio_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`ESPACIO`) REFERENCES `espacio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`IDLINEA`) REFERENCES `linea_factura` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`SERVICIO`) REFERENCES `servicio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_3` FOREIGN KEY (`USUARIO`) REFERENCES `caja` (`USUARIOID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`ALUMNO`) REFERENCES `alumno` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_4` FOREIGN KEY (`ACTIVIDAD`) REFERENCES `actividad` (`NOMBRE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_5` FOREIGN KEY (`EVENTO`) REFERENCES `evento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lesion`
--
ALTER TABLE `lesion`
  ADD CONSTRAINT `lesion_ibfk_3` FOREIGN KEY (`ALUMNO`) REFERENCES `alumno` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesion_ibfk_4` FOREIGN KEY (`EMPLEADO`) REFERENCES `empleado` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  ADD CONSTRAINT `linea_factura_ibfk_2` FOREIGN KEY (`INSCRIPCION`) REFERENCES `inscripcion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_factura_ibfk_3` FOREIGN KEY (`FISIO`) REFERENCES `consultafisio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_factura_ibfk_4` FOREIGN KEY (`DESCUENTO`) REFERENCES `descuento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_factura_ibfk_5` FOREIGN KEY (`TIEMPO_PAGO`) REFERENCES `inscripcion` (`TIEMPO_PAGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_factura_ibfk_6` FOREIGN KEY (`FORMA_PAGO`) REFERENCES `inscripcion` (`FORMA_PAGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_factura_ibfk_7` FOREIGN KEY (`USUARIO`) REFERENCES `caja` (`USUARIOID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `not-alum`
--
ALTER TABLE `not-alum`
  ADD CONSTRAINT `not-alum_ibfk_1` FOREIGN KEY (`IDNOT`) REFERENCES `notificacion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `not-alum_ibfk_2` FOREIGN KEY (`IDALUM`) REFERENCES `alumno` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `not-usu`
--
ALTER TABLE `not-usu`
  ADD CONSTRAINT `not-usu_ibfk_1` FOREIGN KEY (`IDNOT`) REFERENCES `notificacion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `not-usu_ibfk_2` FOREIGN KEY (`IDUSU`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`CLIENTE`) REFERENCES `cliente` (`NIF`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
');

		$crear_tb->execute();
		endif;
		
	}
}
//ejecutamos la función my_db para crear nuestra bd y las tablas
/*$db = new Create_database();
$db->my_db();*/
?>