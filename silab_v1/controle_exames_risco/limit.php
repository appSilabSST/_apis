<?php

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
