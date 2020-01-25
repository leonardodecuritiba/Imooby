<?php

namespace App\Http\Controllers;

use App\Mail\ReplyContact;
use App\Models\Contato;
use App\Models\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    private $name = 'Mensagens';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
            'table' => "messages",
            'link' => "messages",
            'Target' => "Mensagem",
            'Targets' => "Mensagens",
            'Titulo' => "Mensagem",
            'Sex' => "F",
            'titulo_primario' => "",
            'titulo_secundario' => "",
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contatos = Message::all();
        $this->Page->titulo_primario = "Listagem de Contatos";
        return view('admin.' . $this->Page->link . '.index')
            ->with('Page', $this->Page)
            ->with('Contatos', $Contatos);
    }

    public function answer(Request $request, $id)
    {
        $Message = Message::findOrFail($id);
        Mail::to($Message->email)->send(new ReplyContact($request->get('mensagem')));
        $Message->answer();
        return Redirect::route('contatos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->Page->titulo_primario = "Visualizar Mensagem";
        return view('admin.' . $this->Page->link . '.show')
            ->with('Page', $this->Page)
            ->with('Contato', Contato::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Message = Message::findOrFail($id);
        $Message->delete();
        return response()->json(
            [
                'status' => '1',
                'response' => $this->Page->msg_rem
            ]
        );
    }
}
