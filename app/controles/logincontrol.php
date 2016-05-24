<?php
namespace app\controles;
use fw\mods\utilerias\Utilerias;
use fw\mods\plantillas\Constructor;
class LoginControl extends \fw\core\Control {
    public $plantilla;

    function index(){
        $existe_sesion = $this->Login->existeSesion();
        $redireccionar = null;
        if(isset($_POST['usuario']) || $existe_sesion){
            if(isset($_POST['usuario'])&&isset($_POST['clave'])){
                $resultado = $this->Login->inciarSesion($_POST['usuario'],$_POST['clave']);
                if($resultado ==  EXITO){
                    $redireccionar = true;
                }
            }else{
                $redireccionar = $this->Login->verificarSesion() == EXISTO ? true : false;
            }
            if($redireccionar){
                Utilerias::redirectSeguro(DOMINIO."inventario/index/articulo");
            }
        }


        $this->plantilla = new Constructor("Login");
        $this->plantilla->asignarValor("skin","hold-transition login-page");
        $login_parametros=array(
            "titulo" => "Inventario",
            "descripcion" => "Bienvenido, porfavor inicie session para continuar.",
            "input_1_tipo" => "text",
            "input_1_nombre" => "usuario",
            "input_1_placeholder" => "Usuario",
            "input_2_tipo" => "password",
            "input_2_nombre" => "clave",
            "input_2_placeholder" => "Clave",
            "boton_texto" => "ENTRAR",
            "action" => "",
            "method" => "POST"
        );
        $this->plantilla->asignarParcial("content","login",$login_parametros);
        $this->plantilla->mostrar();
    }
}