<?php

namespace App\DAO;

use PDO;
use ReflectionClass;
use ReflectionProperty;

abstract class DAO extends PDO
{
    protected static $conexao = null;

    public function __construct()
    {
        // Sugestão: Use variáveis de ambiente reais ou um arquivo de config separado.
        // Assumindo que $_ENV já está carregado.
        $dsn = "mysql:host={$_ENV['db']['host']};dbname={$_ENV['db']['database']};charset=utf8mb4";

        if (self::$conexao == null) {
            self::$conexao = new PDO(
                $dsn,
                $_ENV['db']['user'],
                $_ENV['db']['pass'],
                [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ // Facilita o retorno como objeto
                ]
            );
        }
    }

    /**
     * Registra o log no banco de dados.
     * @param string $tabela
     * @param int $id_registro
     * @param string $acao (INSERT, UPDATE, DELETE)
     * @param array|null $dados Array estruturado das mudanças
     */
    protected function registerLog(string $tabela, int $id_registro, string $acao, ?array $dados = null)
    {
        $sql = "INSERT INTO sistema_logs (tabela_nome, registro_id, acao, usuario_id, dados) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = self::$conexao->prepare($sql);

        // O PHP converte o array estruturado para JSON automaticamente aqui
        $dados_json = $dados ? json_encode($dados, JSON_UNESCAPED_UNICODE) : null;
        $usuario_id = $_SESSION['usuario_logado']['id'] ?? null;

        $stmt->execute([
            $tabela,
            $id_registro,
            $acao,
            $usuario_id,
            $dados_json
        ]);
    }

    /**
     * Compara dois objetos e retorna um array estruturado das diferenças.
     */
    protected function compararMudancas($antigo, $novo): array
    {
        $mudancas = [];

        // Extrai dados limpos
        $dadosAntigo = $antigo ? $this->extrairDados($antigo) : [];
        $dadosNovo   = $novo   ? $this->extrairDados($novo)   : [];

        // ---------------------------------------------------------
        // CENÁRIO 1: INSERT (Não existia antigo -> Tudo é novo)
        // ---------------------------------------------------------
        if (empty($dadosAntigo)) {
            foreach ($dadosNovo as $key => $val) {
                if ($key === 'id') continue;
                $mudancas[] = [
                    'campo'    => strtoupper($key),
                    'antigo'   => null,
                    'novo'     => $val,
                    'alterado' => false // False para manter fundo branco (clean), pois o card já diz INSERT
                ];
            }
            return $mudancas;
        }

        // ---------------------------------------------------------
        // CENÁRIO 2: DELETE (Não existe novo -> Tudo foi perdido)
        // ---------------------------------------------------------
        if (empty($dadosNovo)) {
            foreach ($dadosAntigo as $key => $val) {
                if ($key === 'id') continue;
                $mudancas[] = [
                    'campo'    => strtoupper($key),
                    'antigo'   => $val, // Mostramos o valor que foi perdido
                    'novo'     => null,
                    'alterado' => false
                ];
            }
            return $mudancas;
        }

        // ---------------------------------------------------------
        // CENÁRIO 3: UPDATE (Comparação campo a campo)
        // ---------------------------------------------------------
        // Pega todas as chaves possíveis dos dois arrays
        $todasChaves = array_unique(array_merge(array_keys($dadosAntigo), array_keys($dadosNovo)));

        foreach ($todasChaves as $chave) {
            if ($chave === 'id') continue;

            $vAntigo = $dadosAntigo[$chave] ?? null;
            $vNovo   = $dadosNovo[$chave]   ?? null;

            // Se os valores forem diferentes
            if ($vAntigo != $vNovo) {
                $mudancas[] = [
                    'campo'    => strtoupper($chave),
                    'antigo'   => $vAntigo,
                    'novo'     => $vNovo,
                    'alterado' => true // True para ativar o fundo amarelo e a seta "->"
                ];
            }
            // Opcional: Se quiser mostrar campos que NÃO mudaram no update (contexto),
            // adicione um 'else' aqui salvando com 'alterado' => false.
        }

        return $mudancas;
    }
    /**
     * Extrai propriedades de um objeto, inclusive privadas, sem caracteres sujos.
     */
    private function extrairDados($objeto): array
    {
        if (is_array($objeto)) return $objeto;
        if (!is_object($objeto)) return [];

        $reflection = new ReflectionClass($objeto);
        $propriedades = $reflection->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);

        $dados = [];
        foreach ($propriedades as $prop) {
            $prop->setAccessible(true);
            $dados[$prop->getName()] = $prop->getValue($objeto);
        }
        return $dados;
    }
}
