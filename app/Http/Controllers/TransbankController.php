<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreTransbankRequest;
//use App\Http\Requests\UpdateTransbankRequest;
use Illuminate\Http\Request;
use App\Models\Transbank;
//use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Http\Controllers\Arr;
use Illuminate\Support\Facades\DB;

class TransbankController extends Controller
{

    // Construtor para Transbank
    public function __construct()
    {
        if( app()->environment('production')){
            WebpayPlus::configueForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        }else{
            WebpayPlus::configureForTesting();
        }
    }

 
    public function iniciar_compra(Request $request){

        DB::select('SET lc_time_names = "es_CL"');

        // Creamos el objeto
        $compra = new Transbank();    

        if($request->tipo == 3){
            
            $valor_total = $request->valordev;
            $compra->sessionId = 'D'.$request->id;

        }else{
         
            $localretiro = DB::select('select local_retiro from RequestTag where id='.$request->id);

            if($localretiro[0]->local_retiro > 1){
                $delivery = DB::select('select valor from valor_delivery order by created_at desc limit 1');
                $valordelivery = $delivery[0]->valor;
                $valor_total = $request->valortag + $valordelivery;
            }else{
                $valor_total = $request->valortag;
            }
         
            $compra->sessionId = $request->id;
        }
       
        $compra->estado = 'Inicio Proceso Compra';
        $compra->total = $valor_total;       
        // Guardamos en la base de datos 
        $compra->save();

        $nueva_compra = [];
        $nueva_compra = array_add($nueva_compra, 'id', $compra->id); //id de registro
        $nueva_compra = array_add($nueva_compra, 'sessionId', $compra->sessionId);
        $nueva_compra = array_add($nueva_compra, 'total', $compra->total);
    // $tarea = DB::insert("insert into transbanks (sessionId,total,created_at,updated_at) values(?,?,?,?)",[$request->id,25000,now(),now()]);

        $url_to_pay = self::start_web_pay_plus_transaction($nueva_compra);
        //return $url_to_pay;
        return redirect($url_to_pay);
        
        

    }

    public function start_web_pay_plus_transaction($nueva_compra){

        $transaccion = (new Transaction)->create(
            $nueva_compra['id'], // buy_order
            $nueva_compra['sessionId'], // session_id
            $nueva_compra['total'], //amount
            route('confirma_pago')  // return_url
        );
        $url = $transaccion->getUrl().'?token_ws='.$transaccion->getToken();

        // Conseguimos el objeto
        $compra_transito=Transbank::where('id', '=', $nueva_compra['id'])->first();
        // Si existe
        if(isset($compra_transito)){
            // Seteamos el dato
            $compra_transito->token_ws = $transaccion->getToken();
            $compra_transito->estado = 'Token de Compra';
            // Guardamos en base de datos
            $compra_transito->save();
        }

        return $url;

    }

    public function confirma_pago(Request $request){

        $confirmacion = (new Transaction)->commit($request->get('token_ws'));
        //dd($confirmacion);
        if($confirmacion->isApproved()){
            $token = $request->get('token_ws');
            // Transacción Aprobada
            // Conseguimos el objeto
            $exito=Transbank::where('token_ws', '=', $request->get('token_ws'))->first();
            // Si existe
            if(isset($exito)){
                // Seteamos el dato
                $exito->vci = $confirmacion->vci;
                $exito->status = $confirmacion->status;
                $exito->responseCode = $confirmacion->responseCode;
                $exito->amount = $confirmacion->amount;
                $exito->authorizationCode = $confirmacion->authorizationCode;
                $exito->paymentTypeCode = $confirmacion->paymentTypeCode;
                $exito->accountingDate = $confirmacion->accountingDate;
                $exito->installmentsNumber = $confirmacion->installmentsNumber;
                $exito->installmentsAmount = $confirmacion->installmentsAmount;
                $exito->buyOrder = $confirmacion->buyOrder;
                $exito->cardNumber = $confirmacion->cardNumber;
                $exito->cardDetail = $confirmacion->cardDetail;
                $exito->transactionDate = $confirmacion->transactionDate;
                $exito->balance = $confirmacion->balance;
                $exito->estado = 'Compra Aprobada';
                // Guardamos en base de datos
                $exito->save();
            }      
            //return view('greeting', ['name' => 'James']);   
            //return view('tag.aprobado');
            return redirect()->action([MensajeriaController::class, 'mensajes'], ['token' => $token]);
            //dd($exito);
        }else{
            // Transacción Rechazada
            // Conseguimos el objeto
            $rechazo=Transbank::where('token_ws', '=', $request->get('token_ws'))->first();
            // Si existe
            if(isset($rechazo)){
                // Seteamos el dato
                $rechazo->vci = $confirmacion->vci;
                $rechazo->status = $confirmacion->status;
                $rechazo->responseCode = $confirmacion->responseCode;
                $rechazo->amount = $confirmacion->amount;
                $rechazo->authorizationCode = $confirmacion->authorizationCode;
                $rechazo->paymentTypeCode = $confirmacion->paymentTypeCode;
                $rechazo->accountingDate = $confirmacion->accountingDate;
                $rechazo->installmentsNumber = $confirmacion->installmentsNumber;
                $rechazo->installmentsAmount = $confirmacion->installmentsAmount;
                $rechazo->buyOrder = $confirmacion->buyOrder;
                $rechazo->cardNumber = $confirmacion->cardNumber;
                $rechazo->cardDetail = $confirmacion->cardDetail;
                $rechazo->transactionDate = $confirmacion->transactionDate;
                $rechazo->balance = $confirmacion->balance;
                $rechazo->estado = 'Compra Rechazada';
                // Guardamos en base de datos
                $rechazo->save();
            }            
            //dd($rechazo);     
            return view('tag.rechazado');       
        }

        

    }

}
