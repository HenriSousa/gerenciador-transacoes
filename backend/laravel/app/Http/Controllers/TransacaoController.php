<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API de Transações",
 *     version="1.0.0",
 *     @OA\Contact(
 *         name="Luiz Henrique de Sousa Costa",
 *         email="henrisousa7@hotmail.com"
 *     )
 * )
 * @OA\Tag(name="Transações", description="Operações relacionadas a transações financeiras")
 * 
 */

/**
 * @OA\Schema(
 *     schema="Transacao",
 *     type="object",
 *     required={"descricao", "valor", "tipo", "categoria"},
 *     @OA\Property(property="id", type="integer", description="ID da transação"),
 *     @OA\Property(property="descricao", type="string", description="Descrição da transação"),
 *     @OA\Property(property="valor", type="number", format="float", description="Valor da transação"),
 *     @OA\Property(property="tipo", type="string", enum={"receita", "despesa"}, description="Tipo da transação"),
 *     @OA\Property(property="categoria", type="string", description="Categoria da transação")
 * )
 */

class TransacaoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/transacoes",
     *     tags={"Transações"},
     *     summary="Listar todas as transações",
     *     @OA\Parameter(
     *         name="tipo",
     *         in="query",
     *         description="Tipo de transação (receita ou despesa)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Uma lista de transações",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Transacao"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Transacao::query();

        $tipo = $request->query('tipo');
        if ($tipo) {
            $query->where('tipo', $tipo);
        }

        $transacoes = $query->get();

        return response()->json($transacoes);
    }

    /**
     * @OA\Get(
     *     path="/api/transacoes/{id}",
     *     tags={"Transações"},
     *     summary="Exibir uma transação específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da transação de acordo com o ID",
     *         @OA\JsonContent(ref="#/components/schemas/Transacao")
     *     ),
     *     @OA\Response(response=404, description="Transação não encontrada")
     * )
     */
    public function show($id)
    {
        $transacao = Transacao::find($id);

        if (!$transacao) {
            return response()->json(['error' => 'Transação não encontrada'], 404);
        }   

        return response()->json($transacao);
    }

    /**
     * @OA\Post(
     *     path="/api/transacoes",
     *     tags={"Transações"},
     *     summary="Criar uma nova transação",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Transacao")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transação criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Transacao")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'tipo' => 'required|in:receita,despesa',
            'categoria' => 'required|string',
        ]);

        $dados['valor'] = $dados['tipo'] === 'despesa' ? -abs($dados['valor']) : abs($dados['valor']);

        $transacao = Transacao::create($dados);
        return response()->json($transacao, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/transacoes/{id}",
     *     tags={"Transações"},
     *     summary="Atualizar uma transação existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Transacao")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transação atualizada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Transacao")
     *     ),
     *     @OA\Response(response=404, description="Transação não encontrada")
     * )
     */
    public function update(Request $request, $id)
    {
        $dados = $request->validate([
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'tipo' => 'required|in:receita,despesa',
            'categoria' => 'required|string',
        ]);

        $transacao = Transacao::find($id);

        if (!$transacao) {
            return response()->json(['error' => 'Transação não encontrada'], 404);
        }

        $dados['valor'] = $dados['tipo'] === 'despesa' ? -abs($dados['valor']) : abs($dados['valor']);
        
        $transacao->update($dados);

        return response()->json($transacao);
    }

     /**
     * @OA\Delete(
     *     path="/api/transacoes/{id}",
     *     tags={"Transações"},
     *     summary="Excluir uma transação",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Transação excluída com sucesso"),
     *     @OA\Response(response=404, description="Transação não encontrada")
     * )
     */
    public function destroy($id)
    {
        $transacao = Transacao::find($id);

        if (!$transacao) {
            return response()->json(['error' => 'Transação não encontrada'], 404);
        }

        $transacao->delete();

        return response()->json(null, 204);
    }
}
