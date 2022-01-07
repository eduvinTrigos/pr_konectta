<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Init extends CI_Controller {

	public function index(){
		$productos=$this->Cs->execsql("SELECT * FROM productos t1 JOIN categorias t2 on t1.id_categoria = t2.id_categoria");
		$categorias=$this->Cs->getCampos('categorias');
		$this->load->view('temples/header');
		$this->load->view('productos',['productos'=>$productos,'categorias'=>$categorias]);
		$this->load->view('temples/footer');
	} 
	public function ventas(){
		
		$this->load->view('temples/header');
		$this->load->view('ventas');
		$this->load->view('temples/footer');
	}
	public function registrar_compra(){
        $id=$this->input->post('id');
        $cantidad=$this->input->post('cantidad');
        $obt_cant=$this->Cs->getCampos('productos',['id'=>$id]);
        if(count($obt_cant)>0){
            if($this->comprobar_stock($id,$cantidad)){

                $registrar_venta=$this->registrar_venta($id,$cantidad);
                if($registrar_venta){
                    $resultante=$obt_cant[0]['stock']-$cantidad;
                    $resul_stock=$this->actualizar_stock($id,$resultante);
                    if($resul_stock){
                        echo json_encode([
                            'msg'=>'Venta realizada con exito',
                            'status'=>true
                        ]);
                        return;
                    }
                    else{
                        echo json_encode([
                            'msg'=>'No se pudo registrar la venta por problemas de actualizaciond e stock',
                            'status'=>false
                        ]);
                        return;
                    }
                }
                else{
                    echo json_encode([
                        'msg'=>'No se pudo registrar la venta',
                        'status'=>false
                    ]);
                    return;
                }
            }
            else{
                echo json_encode([
                    'msg'=>'El producto no cuenta con un stock disponible',
                    'status'=>false
                ]);
                return;
            }
        }
        else{
            echo json_encode([
                'msg'=>'El producto no se encuentra registrado',
                'status'=>false
            ]);
            return;
        }
        
    }
    public function comprobar_stock($id,$canComprar){
        $cantidad=$this->Cs->getCampos('productos',['id'=>$id]);
        if($cantidad[0]['stock']>=$canComprar){
            return true;
        }
        else{
            return false;
        }
    }
    public function actualizar_stock($id,$stock){

        $update=$this->Cs->updaterequest('productos',['id'=>$id],['stock'=>$stock]);
        if($update){
            return true;
        }
        else{
            return false;
        }
    } 
    public function registrar_venta($id_producto,$cantidad){

        $insert=$this->Cs->pushtodb(['id_producto'=>$id_producto,'cantidad'=>$cantidad,'fecha_venta'=>$this->Cs->fechadehoy()],'ventas');
        if($insert){
            return true;
        }
        else{
            return false;
        }
    }
	public function creacion_producto(){
        $data=$this->input->post('data');
        foreach ($data as $key => $value) {
            if($value=='' || $value==NULL ){
                echo json_encode([
                    'msg'=>'Todos los campos son obligatorios',
                    'campo'=>$key
                ]);
                return;
            }
        }
        $data_insert=[
            'nombre'=>$data['nombre'],
            'referencia'=>$data['referencia'],
            'precio'=>$data['precio'],
            'peso'=>$data['peso'],
            'id_categoria'=>$data['categoria'],
            'stock'=>$data['stock'],
            'fecha_creacion'=>$this->Cs->fechadehoy()
        ];
        $insert=$this->Cs->pushtodb($data_insert,'productos');
        if($insert){
            echo json_encode([
                'msg'=>'Producto registrado con exito.',
                'status'=>$insert
            ]);
        }   
        else{
            echo json_encode([
                'msg'=>'Fallo el registro del producto.',
                'status'=>$insert
            ]);
        }
        
    }
    public function eliminacion_producto(){
        $id=$this->input->post('id');
        $verificar_producto=$this->Cs->getCampos('productos',['id'=>$id]);
        if(count($verificar_producto)>0){
            $delete=$this->Cs->deleterequest(['id'=>$id],'productos');
            if($delete){
                echo json_encode([
                    'msg'=>'El producto fue eliminado con exito.',
                    'status'=>$delete 
                ]);
            }
            else{
                echo json_encode([
                    'msg'=>'El producto no pudo ser eliminado.',
                    'status'=>$delete 
                ]);
            }
        }
        else{
            echo json_encode([
                'msg'=>'El producto no se encuentra el registrado.',
                'status'=>false 
            ]);
        }
    }
    public function listar_producto(){
        $id=$this->input->post('id');
        $producto=$this->Cs->getCampos('productos',['id'=>$id]);
        if(count($producto)>0){ 
            echo json_encode([
                'msg'=>'producto encontrado',
                'status'=>true,
                'data'=>$producto[0]
            ]);
        }
        else{
            echo json_encode([
                'msg'=>'producto no encontrado',
                'status'=>false,
                'data'=>null
            ]);
        }
    }
    public function editar_producto(){
        $data=$this->input->post('data');
        foreach ($data as $key => $value) {
            if($value=='' || $value==NULL ){
                echo json_encode([
                    'msg'=>'Todos los campos son obligatorios',
                    'campo'=>$key
                ]);
                return;
            }
        }
        $data_update=[
            'nombre'=>$data['nombre'],
            'referencia'=>$data['referencia'],
            'precio'=>$data['precio'],
            'peso'=>$data['peso'],
            'id_categoria'=>$data['categoria'],
            'stock'=>$data['stock'],
        ];
        $update=$this->Cs->updaterequest('productos',['id'=>$data['id']],$data_update);
        if($update){
            echo json_encode([
                'msg'=>'Producto actualizado con exito.',
                'status'=>$update
            ]);
        }   
        else{
            echo json_encode([
                'msg'=>'Fallo la actualizacion del producto.',
                'status'=>$update
            ]);
        }
    }

}