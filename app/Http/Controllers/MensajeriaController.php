<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Arr;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\LogMensajes;

//use Validator;

class MensajeriaController extends Controller
{

    public function mensajes(Request $request){

        $token = $request->get('token');

        $categoria = DB::select("select sessionid, sessionid REGEXP '^[0-9]+$' AS isNumeric, substring_index(sessionId, 'D', -1) as id from transbanks where token_ws = '".$token."'"); 
        
        if($categoria[0]->isNumeric == 1){

            /* Query */
            $solicitudes = DB::select("select 
            rt.id ,
            rt.fecha_proceso ,
            rt.local ,
            rt.vendedor ,
            rt.tipo ,
            rt.rut ,
            rt.rut_representante ,
            rt.nombre_representante ,
            rt.nombre ,
            rt.direccion ,
            rt.telefono ,
            rt.email ,
            rt.patente ,
            rt.marca ,
            rt.modelo ,
            rt.observaciones ,
            rt.estado ,
            d.id_RequestTag ,
            d.carnetfrontal ,
            d.carnetfrontalempresa ,
            d.primerainscripcion ,
            d.compranotarial ,
            d.padron ,
            d.cav ,
            f.firmaok ,
            f.firma ,
            t.estado as estado_compra ,
            t.transactionDate ,
            t.total ,
            t.token_ws  
            from 
            RequestTag rt 
            left join documents d on rt.id = d.id_RequestTag
            left join firmas f on rt.id = f.id_RequestTag 
            left join transbanks t on rt.id = t.sessionId
            where t.token_ws = '".$token."'");
            /*--------*/

            //phpinfo();
            //dd('s');

            $url = env( 'APP_URL' );
            $id = base64_encode($solicitudes[0]->id);


            QrCode::format('png')->generate($url.'comercio/'.$id, '../public/qrcodes/'.$id.'.png');
            
            //dd('creacion del archivo svg');

            $mensaje = "Estimad@ Cliente {$solicitudes[0]->nombre}, \n Su solicitud de TAG Nro {$solicitudes[0]->id} \n se encuentra en proceso de validación\n";
            $mensaje.= "Una vez aprobada su solicitud se le notificara.\n Indicando Stock disponible para el retiro de su TAG Asignado.";
            
            $mediaUrl = $url.'qrcodes/'.$id.'.png';
        
            $celular = $solicitudes[0]->telefono ;

            $sid    = env( 'TWILIO_SID' );
            $token  = env( 'TWILIO_TOKEN' );
            $twilio = new Client($sid, $token); 
            
            $message = $twilio->messages 
                            ->create("whatsapp:".$celular, // to 
                                    array( 
                                            "mediaUrl" => [$mediaUrl],
                                            "from" => "whatsapp:+14155238886",       
                                            "body" => $mensaje
                                    ) 
                            ); 
            
            //print($message->sid);
            //dd( $mediaUrl );
            //dd('stop');

            //LOG MENSAJERIA//
            $log_mensaje = [];
            $log_mensaje = array_add($log_mensaje, 'id_RequestTag', $solicitudes[0]->id);
            $log_mensaje = array_add($log_mensaje, 'mensaje', 'Solicitud de Tag Creada');
            LogMensajes::create($log_mensaje);
            //////////////////

            return view('tag.aprobado');

        }else{
            $devolucion = DB::select("select * from devoluciones where id = ".$categoria[0]->id);

            $url = env( 'APP_URL' );
            $id = base64_encode($devolucion[0]->id);
            QrCode::format('png')->generate($url.'devolucion/'.$id, '../public/qrcodes/'.$id.'.png');

            $mensaje = "\nEstimad@ Cliente {$devolucion[0]->nombre}, \n Su solicitud de Devolución Nro {$devolucion[0]->id} \n se encuentra recepcionada\n";
            
            $mensaje.= "Puede realizar la entrega de su Tag en los siguientes puntos:\n\n";
        
            $puntos_entrega = DB::select('select nombre, direccion, maquina, kiosko from locals l where deleted_at is null');
    
            foreach ($puntos_entrega as $puntos) {
                $mensaje.= "*- Local $puntos->nombre ,Ubicado en $puntos->direccion\n";
            }
            
            $mediaUrl = $url.'qrcodes/'.$id.'.png';
        
            $celular = $devolucion[0]->telefono ;

            $sid    = env( 'TWILIO_SID' );
            $token  = env( 'TWILIO_TOKEN' );
            $twilio = new Client($sid, $token); 
            
            $message = $twilio->messages 
                            ->create("whatsapp:".$celular, // to 
                                    array( 
                                            "mediaUrl" => [$mediaUrl],
                                            "from" => "whatsapp:+14155238886",       
                                            "body" => $mensaje
                                    ) 
                            );
                            
            alert()->success('Devolución',"Estimado ".$devolucion[0]->nombre." Solicitud ha sido Ingresada con Existo.");                
            return view('tag.aprobado');

        }

    }

    public function mensaje_pendiente($id){


        $solicitudes = DB::select('select 
        rt.id ,
        rt.fecha_proceso ,
        rt.local ,
        rt.vendedor ,
        rt.tipo ,
        rt.rut ,
        rt.rut_representante ,
        rt.nombre_representante ,
        rt.nombre ,
        rt.direccion ,
        rt.telefono ,
        rt.email ,
        rt.patente ,
        rt.marca ,
        rt.modelo ,
        rt.observaciones ,
        rt.estado ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        f.firmaok ,
        f.firma ,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);

        /* ------- Mensajeria ---------------------*/
        // ejemplo codigo instanciar la funcion en un controlador desde otro controlador
        //    $mensaje = new MensajeriaController;
        //    $mensaje->pendientes($solicitudes);
        /* ------- Mensajeria ---------------------*/

        $url = env( 'APP_URL' );
        $id = base64_encode($solicitudes[0]->id);
        $url.='pendiente_datos/'.$id;
    
        $mensaje = "Estimad@ Cliente {$solicitudes[0]->nombre}, \n Su solicitud de TAG Nro {$solicitudes[0]->id} se encuentra incompleta en lo siguiente: \n";

        if ($solicitudes[0]->datos=='incompleto') {
            $mensaje.= "* Item de Datos : {$solicitudes[0]->datos}\n";
        }
        if ($solicitudes[0]->documentos=='incompleto') {
            $mensaje.= "* Item de Documentos : {$solicitudes[0]->documentos}\n";
        }
        if ($solicitudes[0]->firma=='incompleto') {
            $mensaje.= "* Item de Firma : {$solicitudes[0]->firma}\n\n";
        }
        $mensaje.='Link de Acceso : ';

        $mensaje.=$url;
        
        $celular = $solicitudes[0]->telefono ;
    
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create("whatsapp:".$celular, // to 
                                   array( 
                                        "from" => "whatsapp:+14155238886",       
                                        "body" => $mensaje
                                   ) 
                          ); 

    //LOG MENSAJERIA//
    $log_mensaje = [];
    $log_mensaje = array_add($log_mensaje, 'id_RequestTag', $solicitudes[0]->id);
    $log_mensaje = array_add($log_mensaje, 'mensaje', 'Solicitud de Tag Incompleta');
    LogMensajes::create($log_mensaje);
    //////////////////

    return redirect()->back();

    }

    public function pago_pendiente($id){


        $solicitudes = DB::select('select 
        rt.id ,
        rt.fecha_proceso ,
        rt.local ,
        rt.vendedor ,
        rt.tipo ,
        rt.rut ,
        rt.rut_representante ,
        rt.nombre_representante ,
        rt.nombre ,
        rt.direccion ,
        rt.telefono ,
        rt.email ,
        rt.patente ,
        rt.marca ,
        rt.modelo ,
        rt.observaciones ,
        rt.estado ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        f.firmaok ,
        f.firma ,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);

        $url = env( 'APP_URL' );
        $id = base64_encode($solicitudes[0]->id);
        $url.='pendiente_pago/'.$id;
    
        $mensaje = "Estimad@ Cliente {$solicitudes[0]->nombre}, \n Su solicitud de TAG Nro {$solicitudes[0]->id} se encuentra incompleta en lo siguiente: \n";

        $mensaje.= "* Pago de TAG Pendiente\n\n";
        $mensaje.='Link de Acceso : ';

        $mensaje.=$url;
        
        $celular = $solicitudes[0]->telefono ;
    
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create("whatsapp:".$celular, // to 
                                   array( 
                                        "from" => "whatsapp:+14155238886",       
                                        "body" => $mensaje
                                   ) 
                          ); 

        //LOG MENSAJERIA//
        $log_mensaje = [];
        $log_mensaje = array_add($log_mensaje, 'id_RequestTag', $solicitudes[0]->id);
        $log_mensaje = array_add($log_mensaje, 'mensaje', 'Solicitud de Tag Pago Pendiente');
        LogMensajes::create($log_mensaje);
        //////////////////

    return redirect()->back();

    }

    public function mensaje_estado_aprobado($id){

        $solicitudes = DB::select('select 
        rt.id ,
        rt.fecha_proceso ,
        rt.local ,
        rt.vendedor ,
        rt.tipo ,
        rt.rut ,
        rt.rut_representante ,
        rt.nombre_representante ,
        rt.nombre ,
        rt.direccion ,
        rt.telefono ,
        rt.email ,
        rt.patente ,
        rt.marca ,
        rt.modelo ,
        rt.observaciones ,
        rt.estado ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        f.firmaok ,
        f.firma ,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);

        $url = env( 'APP_URL' );
        $id = base64_encode($solicitudes[0]->id);
        $url.='comercio/'.$id;
    
        $mensaje = "Estimad@ Cliente {$solicitudes[0]->nombre}, \nSu solicitud de TAG Nro {$solicitudes[0]->id} se encuentra disponible para retiro \n";

        $mensaje.= "En los siguientes puntos de entrega:\n\n";
        
        $puntos_entrega = DB::select('select nombre, direccion, maquina, kiosko from locals l where deleted_at is null');

        foreach ($puntos_entrega as $puntos) {
            $mensaje.= "*- Local $puntos->nombre ,Ubicado en $puntos->direccion\n";
        }

        //$mensaje.= "Puede usar el codigo QR enviado anteriormente o el siguiente enlace";
        //$mensaje.="\n\nLink : ".$url;
        
        $celular = $solicitudes[0]->telefono ;
    
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create("whatsapp:".$celular, // to 
                                   array( 
                                        "from" => "whatsapp:+14155238886",       
                                        "body" => $mensaje
                                   ) 
                          ); 

            //LOG MENSAJERIA//
            $log_mensaje = [];
            $log_mensaje = array_add($log_mensaje, 'id_RequestTag', $solicitudes[0]->id);
            $log_mensaje = array_add($log_mensaje, 'mensaje', 'Solicitud de Tag Aprobado');
            LogMensajes::create($log_mensaje);
            //////////////////

        return redirect()->back();
    }


    public function mensaje_estado_habilitado($id){

        $solicitudes = DB::select('select 
        rt.id ,
        rt.fecha_proceso ,
        rt.local ,
        rt.vendedor ,
        rt.tipo ,
        rt.rut ,
        rt.rut_representante ,
        rt.nombre_representante ,
        rt.nombre ,
        rt.direccion ,
        rt.telefono ,
        rt.email ,
        rt.patente ,
        rt.marca ,
        rt.modelo ,
        rt.observaciones ,
        rt.estado ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        f.firmaok ,
        f.firma ,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);
   
        $mensaje = "Estimad@ Cliente {$solicitudes[0]->nombre}, \nSu TAG se encuentra habilitado.";
        
        $celular = $solicitudes[0]->telefono ;
    
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create("whatsapp:".$celular, // to 
                                   array( 
                                        "from" => "whatsapp:+14155238886",       
                                        "body" => $mensaje
                                   ) 
                          ); 

            //LOG MENSAJERIA//
            $log_mensaje = [];
            $log_mensaje = array_add($log_mensaje, 'id_RequestTag', $solicitudes[0]->id);
            $log_mensaje = array_add($log_mensaje, 'mensaje', 'Solicitud de Tag Habilitado');
            LogMensajes::create($log_mensaje);
            //////////////////

        return redirect()->back();
    }
}
