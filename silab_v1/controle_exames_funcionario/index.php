<?php

$option_value = array();
$columns = "*";
$join = " ";
$where = " ";
$order_by = " ";
$group_by = " ";
$limit = " ";

if (isset($_GET["columns"])) {
    $dados = base64_decode($_GET["columns"]);

    $dados = json_decode($dados, true);

    if (isset($dados['basic'])) {
        $body_columns = explode(",", $dados['basic']);
        foreach ($body_columns as $key => $column) {
            if ($column == 'exame' || $column == 'sala_atendimento') {
                $body_columns[$key] = "exame.$column";;
                if (strpos($join, 'exame on') === false) {
                    $join .= "INNER JOIN exame on exame.id_exame = $table.id_exame";
                }
            } else {
                $body_columns[$key] = $table . "." . $column;
            }
        }
    }
    if (isset($dados['extensions'])) {
        foreach ($dados['extensions'] as $key => $column) {
            $body_columns[$key] = "$column as $key";
        }
    }

    $columns = implode(',',  $body_columns);
}

if (isset($_GET["where"])) {
    $dados = json_decode(base64_decode($_GET['where']), true);
    // $where = json_decode($_GET['where'], true);

    foreach ($dados as $key => $value) {
        $i = 0;
        if ($key == "sala_atendimento") {
            if (strpos($value, ',') === false) {
                $body_where[] = "exame." . $key . " :" . str_replace($cond, "", $key);
                $option_value[":" . str_replace($cond, "", $key)] = $value;
            } else {
                $ids = explode(',', $value);
                foreach ($ids as $id) {
                    $i++;
                    $nova_key[$i] = " :" . $key . "_" . $i . "";
                    $option_value[$nova_key[$i]] = $id;
                }
                $body_where[] = "exame." . $key . " in (" . implode(",", $nova_key) . ")";
            }
            if (strpos($join, 'exame on') === false) {
                $join .= "INNER JOIN exame on exame.id_exame = $table.id_exame";
            }
        } else {
            if (strpos($value, ',') === false) {
                $body_where[] = $table . "." . $key . " :" . str_replace($cond, "", $key);
                $option_value[":" . str_replace($cond, "", $key)] = $value;
            } else {
                $ids = explode(',', $value);
                foreach ($ids as $id) {
                    $i++;
                    $nova_key[$i] = ":" . $key . "_" . $i . "";
                    $option_value[$nova_key[$i]] = $id;
                }
                $body_where[] = $table . "." . $key . " in (" . implode(",", $nova_key) . ")";
            }
        }
    }

    $body_where = implode(" AND ", $body_where);

    $where = " WHERE  $body_where";
}

if (isset($_GET["order_by"])) {
    $dados = json_decode(base64_decode($_GET['order_by']), true);

    foreach ($dados as $key => $value) {
        if ($key == "######") {
            $body_order_by[] = "######." . $key . " :" . $key;
            $option_value[":$key"] = $value;
            if (strpos($join, '"######."') === false) {
                $join .= "########";
            }
        } else {
            $body_order_by[] = $table . "." . $key . " :" . $key;
            $option_value[":$key"] = $value;
        }
    }
    $order_by = " ORDER BY  $body_order_by";
}


if (isset($_GET["group_by"])) {
    $dados = json_decode(base64_decode($_GET['group_by']), true);

    foreach ($dados as $key => $value) {
        if ($key == "######") {
            $body_group_by[] = "######." . $key . " :" . $key;
            $option_value[":$key"] = $value;
            if (strpos($join, '"######."') === false) {
                $join .= "########";
            }
        } else {
            $body_group_by[] = $table . "." . $key . " :" . $key;
            $option_value[":$key"] = $value;
        }
    }
    $group_by = " GROUP BY $body_group_by";
}


if (isset($_GET["limit"])) {

    $dados = json_decode(base64_decode($_GET['limit']), true);

    foreach ($dados as $key => $value) {
        if ($key == "######") {
            $body_limit[] = "######." . $key . " :" . $key;
            $option_value[":$key"] = $value;
            if (strpos($join, '"######."') === false) {
                $join .= "########";
            }
        } else {
            $body_limit[] = $table . "." . $key . " :" . $key;
            $option_value[":$key"] = $value;
        }
    }
    $limit = " LIMIT  $body_limit";
}
