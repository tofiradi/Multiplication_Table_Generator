<?php

/*Generating the table for the PHP CLI version by first putting every record
 * into an array for a later format.
 */
function generateTable($height, $width) {

    //Main array.
    $data_array = [];

    // Create first row of table headers.
    $header_array = [chr(27) . "[93m" . "X" . chr(27) . "[0m"];

    for ($col = 1; $col <= $width; $col++) {

        $header_array [] .= chr(27) . "[93m" . $col . chr(27) . "[0m";
    }

    //Main array containing a sub-array of the table's header columns.
    $data_array [] = $header_array;

    for ($row = 1, $col = 1; $row <= $height; $row++) {
        $rows_array = [];

        // First cell is a table header.
        if ($col === 1) {

            $rows_array [] .= chr(27) . "[93m" . $row . chr(27) . "[0m";

        }

        while ($col <= $width) {

            $rows_array [] .= chr(27) . "[97m" . $row * $col++ . chr(27) .
                    "[0m";
        }

        /*Main array now contains a sub-array of the table's header columns
         * and several sub-arrays of the table's rows (i.e. an array
         * for each row).
         */
        $data_array [] = $rows_array;
        $col = 1;

    }

    $result = formatTable($data_array);
    return $result;

}

//Formatting cells to have an even size.
function formatTable($data) {

    // Find longest string in each column.
    $columns = [];

    foreach ($data as $row_key => $row) {

        foreach ($row as $cell_key => $cell) {

            $length = strlen($cell);

            if (empty($columns[$cell_key]) || $columns[$cell_key] < $length) {

                $columns[$cell_key] = $length;

            }

        }

    }

    // Output table, padding columns.
    $render_table = "";

    foreach ($data as $row_key => $row) {

        foreach ($row as $cell_key => $cell) {

            $render_table .= str_pad($cell, $columns[$cell_key]) . "   ";

        }

        $render_table .= PHP_EOL;

    }

    return $render_table;

}

// Generating the table for the HTML version.
function generateTableHtml($height, $width) {

    $render_table = "<table>";

    // Create first row of table headers.
    $render_table .= "<tr>";
    $render_table .= "<th>X</th>";

    for ($col = 1; $col <= $width; $col++) {

        $render_table .= "<th>$col</th>";

    }

    $render_table .= "</tr>";

    // Create the remaining rows.
    for ($row = 1, $col = 1; $row <= $height; $row++) {

        $render_table .= "<tr>";

        // First cell is a table header.
        if ($col === 1) {

            $render_table .= "<th>$row</th>";

        }

        while ($col <= $width) {

            $render_table .= "<td>" . $row * $col++ . "</td>";

        }

        $render_table .= "</tr>";

        // Reset column at the end of each row.
        $col = 1;

    }

    $render_table .= "</table>";

    return $render_table;

}
