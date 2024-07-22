<?php
if (isset($_GET["order_by"])) {
    $dados = json_decode(base64_decode($_GET['order_by']), true);

    foreach ($dados as $tab => $value) {
        if ($tab == $table) {
            $body = explode(",", $value);
            foreach ($body as $key => $column) {
                $body_order_by[] = $tab . "." . $column;
            }
        } elseif ($tab == '************') {
            $body = explode(",", $value);
            foreach ($body as $key => $column) {
                $body_order_by[] = $tab . "." . $column;
            }
        }
    }

    $body_order_by = implode(",", $body);

    $order_by = " ORDER BY  $body_order_by";
}
