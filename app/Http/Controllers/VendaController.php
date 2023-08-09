<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestVenda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function index(Request $request)
    {
        $pesquisar = $request->pesquisar;
        $findVendas = $this->venda->getVendasPesquisarIndex(search: $pesquisar ?? '');

        return view('pages.vendas.paginacao', compact('findVendas'));
    }


    public function cadastrarVendas(FormRequestVenda $request)
    {
        $findNumeracao = Venda::max('numero_da_venda') + 1;
        $findProduto =  Produto::all();
        $findCliente =  Cliente::all();

        if ($request->method() == "POST") {
            // cria os dados
            $data = $request->all();
            $data['numero_da_venda'] = $findNumeracao;

            Venda::create($data);

            Toastr::success('Dados gravados com sucesso.');
            return redirect()->route('vendas.index');
        }
        // mostrar os dados

        return view('pages.vendas.create', compact('findNumeracao', 'findProduto', 'findCliente'));
    }
}
