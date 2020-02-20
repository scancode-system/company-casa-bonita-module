<?php

namespace Modules\CompanyCasaBonita\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CompanyCasaBonita\Entities\CasaBonitaOrder;
use Modules\Order\Entities\Order;
use Modules\CompanyCasaBonita\Services\CasabonitaApi;

class ApiController extends Controller
{

    public function index()
    {
        $casa_bonita_orders = CasaBonitaOrder::all();

        $pedidos = Order::where('status_id', 2)->doesntHave('casa_bonita_order')->get();

        $casabonita_pedidos_sucesso = CasaBonitaOrder::where('status', 200)->get();
        $casabonita_pedidos_erro = CasaBonitaOrder::where('status', 500)->get();


        return view('companycasabonita::api.index', ['pedidos' => $pedidos,'casabonita_pedidos_sucesso' => $casabonita_pedidos_sucesso,'casabonita_pedidos_erro' => $casabonita_pedidos_erro]);

    }

    public function store(Request $request, Order $order)
    {
        $pedido = $order;
        $casabonita_api = new CasabonitaApi();
        $data = $casabonita_api->import($pedido);

        try {
            $casabonita_pedido = CasaBonitaOrder::where('order_id', $pedido->id)->first();
            if(!$casabonita_pedido)
                CasaBonitaOrder::create(['order_id' => $pedido->id, 'status' => $data['status'], 'message' => $data['message'], 'codigo' => $data['codigo']]);
            else {
                $casabonita_pedido->update(['status' => $data['status'], 'message' => $data['message'], 'codigo' => $data['codigo']]);
            }
        } catch(Excption $e){

        }

        if($data['status'] == 200){
            return back()->with('message', 'Pedido importado com sucesso.');
        } else {
            return back()->withErrors('Falha na na importação');
        }
    }

    public function storeAll(Request $request)
    {
        $pedidos = Order::where('status_id', 2)->doesntHave('casa_bonita_order')->get();
        $sucesso = 0;
        $falhas = 0;
        foreach ($pedidos as $i => $pedido) {
            $casabonita_api = new CasabonitaApi();
            $data = $casabonita_api->import($pedido);
            //dd($data);
            try {
                $casabonita_pedido = CasaBonitaOrder::where('order_id', $pedido->id)->first();
                if(!$casabonita_pedido)
                    CasaBonitaOrder::create(['order_id' => $pedido->id, 'status' => $data['status'], 'message' => $data['message'], 'codigo' => $data['codigo']]);
                else {
                    $casabonita_pedido->update(['status' => $data['status'], 'message' => $data['message'], 'codigo' => $data['codigo']]);
                }
            } catch(Excption $e){

            }

            if($data['status'] == 200){
                $sucesso++;
            } else {
                $falhas++;
            }
            
        }
        //die();
        return back()->with('message', 'Importação finalizada com '.$sucesso.' sucessos e '.$falhas.' falhas');
    }

}
