<?php

if (isset($_GET["where"])) {
    $dados = json_decode(base64_decode($_GET['where']), true);
    foreach ($dados as $key => $value) {
        if ($key == $table) {
            foreach ($value as $chaves => $val) {
                $i = 0;
                if (strpos($val, ',') === false) {
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves);
                    $option_value[":" . str_replace($condicoes_where, "", $chaves)] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
        } else if ($key == "controle_funcao_empresa") {
            $i = 0;
            foreach ($value as $chaves => $val) {
                if (strpos($val, ',') === false) {
                    $i++;
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves) . "$i";
                    $option_value[":" . str_replace($condicoes_where, '', $chaves) . "$i"] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
            if (strpos($join, "$tab on") === false) {
                $join .= " join $tab on $tab.id_setor_empresa = $table.codigo";
            }
        } else if ($key == "controle_riscos_empresa") {
            $i = 0;
            foreach ($value as $chaves => $val) {
                if (strpos($val, ',') === false) {
                    $i++;
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves) . "$i";
                    $option_value[":" . str_replace($condicoes_where, '', $chaves) . "$i"] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
            if (strpos($join, "$tab on") === false) {
                $join .= " JOIN  $tab on $tab.id_setor_empresa = $table.codigo";
            }
        } else if ($key == "*************") {
            $i = 0;
            foreach ($value as $chaves => $val) {
                if (strpos($val, ',') === false) {
                    $i++;
                    $body_where[] = "$key.$chaves :" . str_replace($condicoes_where, '', $chaves) . "$i";
                    $option_value[":" . str_replace($condicoes_where, '', $chaves) . "$i"] = $val;
                } else {
                    $ids = explode(',', $val);
                    foreach ($ids as $id) {
                        $i++;
                        $nova_key[$i] = " :$chaves" . "_" . $i . "";
                        $option_value[$nova_key[$i]] = $id;
                    }
                    $body_where[] = "$key.$chaves :" . " in (" . implode(",", $nova_key) . ")";
                }
            }
        }
    }

    $body_where = implode(" AND ", $body_where);

    $where = " WHERE  $body_where";
}
