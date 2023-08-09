<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestClientes;
use App\Models\Cliente;
use App\Models\Componentes;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    public function index(Request $request)
    {
        $pesquisar = $request->pesquisar;
        $findCliente = $this->cliente->getClientesPesquisarIndex(search: $pesquisar ?? '');    //Cliente::all();
        // dd($findCliente); 

        return view('pages.clientes.paginacao', compact('findCliente'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = Cliente::find($id);
        $buscaRegistro->delete();

        return response()->json(['success' => true]);
    }

    public function cadastrarCliente(FormRequestClientes $request)
    {
        if ($request->method() == "POST") {
            //cria os dados
            $data = $request->all();
            $componentes = new Componentes();

            Cliente::create($data);
            Toastr::success('Dados gravados com sucesso.');
            return redirect()->route('clientes.index');
        }

        return view('pages.clientes.create');
    }

    public function atualizarCliente(FormRequestClientes $request, $id)
    {
        if ($request->method() == "PUT") {
            // atualiza os dados
            $data = $request->all();
            $componentes = new Componentes();

            $buscaRegistro = Cliente::find($id);
            $buscaRegistro->update($data);

            Toastr::success('Dados atualizados com sucesso.');
            return redirect()->route('cliente.index');
        }
        $findCliente = Cliente::where('id', '=', $id)->first();
        return view('pages.clientes.atualiza', compact('findCliente'));
    }
}
