<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $products = Products::with('subProducts.product')->get();
            $response = array();
            $response["response"]["products"] = $products;
            return $response;
        }catch( \Exception $e){
            $response["response"]["errors"] = $e;
            return $response;
        }
    }

    public function commands(Request $request)
    {
        //
        $request->validate([
            'file' => 'required|max:10000',
        ]);
        
        $path = $request->file('file')->getRealPath();

        $rows = Excel::load($path, function($reader) {
            $reader->toArray();
            $reader->noHeading();
        })->get();

        $success = array();
        $failures = array();
       foreach ($rows as $row) {
           $command = array(
                'id_product' => $row[0],
                'command' => $row[1],
                'quantity' => $row[2],
            );
            $product = Products::find($command['id_product']);
            if(count($product) > 0) {
               switch($command['command']){
                case 'Agregar':
                    try{
                        $product->increment('quantity', $command['quantity']);
                        $success[] = $command;
                    }catch(\Exception $e){
                        $failures[] = $command;
                    }
                break;
                case 'Restar':
                    try{
                        $product->decrement('quantity', $command['quantity']);
                        $success[] = $command;
                    }catch(\Exception $e){
                        $failures[] = $command;
                    }
                break;
                case 'Activar':
                    $product->active = true;
                    $product->save();
                    $success[] = $command;
                break;
                case 'Desactivar':
                    $product->active = false;
                    $product->save();
                    $success[] = $command;
                break;
               }
            }else{
                $failures[] = $command;
            }
        }
        $response['response']['success'] = $success;
        $response['response']['failures'] = $failures;
        return $response;
    }
}
