<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProduto;
use App\Models\Componentes;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
    public function index(Request $request)
    {
        $pesquisar = $request->pesquisar;
        $findProduto = $this->produto->getProdutosPesquisarIndex(search: $pesquisar ?? '');    //Produto::all();
        // dd($findProduto); 

        return view('pages.produtos.paginacao', compact('findProduto'));
    }

        public function delete(Request $request){
            $id = $request->id;
            $buscaRegistro = Produto::find($id);
            $buscaRegistro->delete();

            return response()->json(['success' => true]);
        }

        public function cadastrarProduto(FormRequestProduto $request){
            if($request->method() == "POST"){
                //cria os dados
                $data = $request->all();
                $componentes = new Componentes();
                $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);

                Produto::create($data);

                return redirect()->route('produto.index');
            }

            return view('pages.produtos.create');
        }
}
