<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ("conexao.php");
include ("funcoes.php");

if (!empty($_GET["table"])) {

    $method = $_SERVER["REQUEST_METHOD"];
    $w = array();
    $b = array();
    $b2 = array();
    $option_value = array();
    $columns = "*";
    $join = " ";
    $where = " ";
    $order_by = " ";
    $group_by = " ";
    $limit = " ";
    $condicoes_where = array("=", "!=", "<>", ">", "<", ">=", "<=", "LIKE", "BETWEEN", "IN", " ", "!");
    $table = str_replace('"', '', base64_decode($_GET["table"]));

    if ($method == "GET") {

        try {

            include ("./$table/columns.php");
            include ("./$table/where.php");
            include ("./$table/order_by.php");
            include ("./$table/group_by.php");
            include ("./$table/limit.php");

            // echo $sql = "SELECT $columns FROM $table $join $where $group_by $order_by $limit";
            // var_dump($option_value);
            // exit;


            // Prepara a consulta SQL
            $sql = "SELECT $columns FROM $table $join $where $group_by $order_by $limit";

            $stmt = $conecta->prepare($sql);

            if (isset($option_value)) {
                foreach ($option_value as $key => $value) {
                    $stmt->bindValue("$key", "$value");
                }
            }

            $stmt->execute();

            // Obtém os dados
            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (!$dados) {
                $result = ["status" => "fail", "error" => "Registro não encontrado"];
            } elseif ($stmt->errorCode() !== "00000") {
                $result = ["status" => "fail", "error" => $stmt->errorInfo()];
            } else {
                $result = $dados;
            }

            // Prepara o resultado
            // $result = array("status" => "success", "items" => $dados);
            $result = $dados;
            http_response_code(200);
        } catch (PDOException $ex) {
            // Trata exceções do PDO
            $result = array("status" => "fail", "error" => $ex->getMessage());
            http_response_code(500);
        } catch (ErrorException $ex) {
            // Trata erros de validação
            $result = array("status" => "fail", "error" => $ex->getMessage());
            http_response_code(400);
        } finally {
            // Retorna o resultado como JSON
            echo json_encode($result);
        }
    } elseif ($method == "POST") {
        // echo 'Lógica para o método PUT';
        // exit;
        try {
            //Recupera dados do corpo (body) de uma requisição POST
            $dados = file_get_contents("php://input");

            //Decodifica JSON, sem opção TRUE
            $dados = json_decode($dados, true);  //Isso retorna um array associativo

            foreach ($dados['option'] as $key => $value) {
                $b[] = "$key";
                $b2[] = ":$key";
                $params[":$key"] = $value;
            }

            $body1 = implode(', ', $b);
            $body2 = implode(', ', $b2);

            if (empty($body1) && empty($body2)) {
                http_response_code(404); // Not Found
                echo json_encode(["status" => "fail", "error" => "Nenhum campo a ser atualizado fornecido"]);
                exit;
            }

            // echo $sql = "insert into $table ($body1) values ($body2)";
            // var_dump($params);
            // exit;


            $sql = "insert into $table ($body1) values ($body2)";

            $stmt = $conecta->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue("$key", $value);
            }

            $stmt->execute();

            if ($stmt->errorCode() !== "00000") {
                $result = ["status" => "fail", "error" => $stmt->errorInfo()];
            } else {
                // Obter o ID do último registro inserido
                $id = $conecta->lastInsertId();
                $result = ["status" => "success", "id" => $id];
            }

        } catch (PDOException $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(500);
        } catch (Exception $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(400);
        } finally {
            $conecta = null;
            echo json_encode($result);
        }
    } elseif ($method == "PUT") {
        try {
            //Recupera dados do corpo (body) de uma requisição POST
            $dados = file_get_contents("php://input");

            //Decodifica JSON, sem opção TRUE
            $dados = json_decode($dados, true);  //Isso retorna um array associativo

            foreach ($dados['option'] as $key => $value) {
                $b[] = "$key=:$key";
                $params[":$key"] = $value;
            }

            foreach ($dados['where'] as $key => $value) {
                $w[] = "$key=:$key";
                $params[":$key"] = $value;
            }

            $body = implode(',', $b);
            $where = implode(' and ', $w);

            if (empty($body)) {
                http_response_code(404); // Not Found
                echo json_encode(["status" => "fail", "error" => "Nenhum campo a ser atualizado fornecido"]);
                exit;
            }

            $sql = "UPDATE $table SET $body WHERE $where ";

            $stmt = $conecta->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue("$key", $value);
            }

            $stmt->execute();

            $result = array("status" => "success");
        } catch (PDOException $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(500);
        } catch (Exception $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(400);
        } finally {
            $conecta = null;
            echo json_encode($result);
        }
    } elseif ($method == "PATCH") {
        try {
            //Recupera dados do corpo (body) de uma requisição POST
            $dados = file_get_contents("php://input");

            //Decodifica JSON, sem opção TRUE
            $dados = json_decode($dados, true);  //Isso retorna um array associativo

            foreach ($dados['option'] as $key => $value) {
                $b[] = "$key=:$key";
                $params[":$key"] = $value;
            }

            foreach ($dados['where'] as $key => $value) {
                $w[] = "$key=:$key";
                $params[":$key"] = $value;
            }

            $body = implode(',', $b);
            $where = implode(' and ', $w);

            if (empty($body)) {
                http_response_code(404); // Not Found
                echo json_encode(["status" => "fail", "error" => "Nenhum campo a ser atualizado fornecido"]);
                exit;
            }

            $sql = "UPDATE $table SET $body WHERE $where ";

            $stmt = $conecta->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue("$key", $value);
            }

            $stmt->execute();

            $result = array("status" => "success");
        } catch (PDOException $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(500);
        } catch (Exception $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(400);
        } finally {
            $conecta = null;
            echo json_encode($result);
        }
    } elseif ($method == "DELETE") {
        try {
            if (empty($_GET['where'])) {
                //Está vazio ou não é númerico: ERRO
                throw new ErrorException("Valor inválido", 1);
            }
            $wh = json_decode(base64_decode($_GET["where"]));

            foreach ($wh as $key => $value) {
                $w[] = "$key = :$key";
                $params[":$key"] = $value;
            }

            $where = implode(' and ', $w);

            // echo $sql = "DELETE FROM $table WHERE $where";
            // exit;

            $sql = "DELETE FROM $table WHERE $where";

            $stmt = $conecta->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue("$key", $value);
            }

            $stmt->execute();

            if ($stmt->errorCode() !== "00000") {
                $result = ["status" => "fail", "error" => $stmt->errorInfo()];
            } else {
                $result = ["status" => "success"];
            }

        } catch (PDOException $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(200);
        } catch (Exception $ex) {
            $result = ["status" => "fail", "Error" => $ex->getMessage()];
            http_response_code(200);
        } finally {
            $conecta = null;
            echo json_encode($result);
        }
    }
} else {
    echo json_encode(array('status' => 'fail', 'msg' => 'parametro table não foi definida'));
}
