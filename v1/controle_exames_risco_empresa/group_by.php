<?php
if (isset($_GET["group_by"])) {
    $dados = json_decode(base64_decode($_GET['group_by']), true);

    foreach ($dados as $tab => $value) {
        if ($tab == $table) {
            $body = explode(",", $value);
            foreach ($body as $key => $column) {
                $body_group_by[] = $tab . "." . $column;
            }
        } elseif ($tab == '************') {
            $body = explode(",", $value);
            foreach ($body as $key => $column) {
                $body_group_by[] = $tab . "." . $column;
            }
        }
    }

    $body_group_by = implode(",", $body_group_by);

    $group_by = " GROUP BY $body_group_by";
}
