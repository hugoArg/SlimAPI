<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app = new \Slim\App;
// GETtodos los registros
$app->get('/api/clientes',function(Request $request,Response $respose){

    $sql = "SELECT * FROM clientes";
    try{

        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);
        if($resultado->rowCount()>0){
            $clientes =$resultado ->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($clientes);
        }else{
            echo json_encode("NO Registros en BD");
        }
$resultado = null;
$db= null;
    }catch(PDOException $e){
        echo '{"errores" : {"text":'.$e->getMessage().'}';
    }
});

// GET x ID
$app->get('/api/clientes/{id}',function(Request $request,Response $respose){
    $id_cliente = $request ->getAttribute('id');
    $sql = "SELECT * FROM clientes WHERE id = $id_cliente";
    try{

        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);
        if($resultado->rowCount()>0){
            $clientes =$resultado ->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($clientes);
        }else{
            echo json_encode("NO encontrado en BD");
        }
$resultado = null;
$db= null;
    }catch(PDOException $e){
        echo '{"errores" : {"text":'.$e->getMessage().'}';
    }
});

// POST nuevo registro
$app->post('/api/clientes/nuevo',function(Request $request,Response $respose){
    $nombre = $request ->getParsedBody()['nombre'];
    $apellido = $request ->getParsedBody()['apellido'];
    $telefono= $request ->getParsedBody()['telefono'];
    
$nombreHash =  password_hash($nombre,PASSWORD_DEFAULT);
    
    
    $sql = "INSERT INTO clientes (nombre,apellido,telefono)VAlUES(:nombre,:apellido,:telefono)";
    try{

        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);

$resultado->bindParam(':nombre',$nombre);
$resultado->bindParam(':apellido',$apellido);
$resultado->bindParam(':telefono',$telefono);

$resultado->execute();
echo json_encode("REGISTRO GUARDADO");

$resultado = null;
$db= null;
    }catch(PDOException $e){
        echo '{"errores" : {"text":'.$e->getMessage().'}';
    }
});

// PUT editar registro
$app->put('/api/clientes/cambiar/{id}',function(Request $request,Response $respose){
    $id_registro = $request->getAttribute('id');
    $nombre = $request ->getParsedBody()['nombre'];
    $apellido = $request ->getParsedBody()['apellido'];
    $telefono= $request ->getParsedBody()['telefono'];
    
    $sql = "UPDATE clientes SET 
         nombre = :nombre,
        apellido = :apellido,
        telefono = :telefono
    WHERE id = $id_registro";
    try{

        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);

$resultado->bindParam(':nombre',$nombre);
$resultado->bindParam(':apellido',$apellido);
$resultado->bindParam(':telefono',$telefono);

$resultado->execute();
echo json_encode("REGISTRO EDITADO");

$resultado = null;
$db= null;
    }catch(PDOException $e){
        echo '{"errores" : {"text":'.$e->getMessage().'}';
        echo json_encode($id_registro);
        echo json_encode($nombre);
        echo json_encode($apellido);
        echo json_encode($telefono);

    }
});

// DELETE ELIMINAR registro
$app->delete('/api/clientes/borrar/{id}',function(Request $request,Response $respose){
    $id_registro = $request->getAttribute('id');

    
    $sql = "DELETE FROM clientes 
    WHERE id = $id_registro";
    try{

        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);
$resultado->execute();
if($resultado->rowCount()>0){
echo json_encode('REGISTRO ELIMINADO');

}else{
echo json_encode('NO EXISTE REGISTRO');

}



$resultado = null;
$db= null;
    }catch(PDOException $e){
        echo '{"errores" : {"text":'.$e->getMessage().'}';
    

    }
});
