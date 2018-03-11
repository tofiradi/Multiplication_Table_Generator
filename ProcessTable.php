<?php

//Enabling strict typing feature.
declare(strict_types = 1);

//If the execution is not made via browser ( i.e. otherwise through PHP CLI).
if (!isset($_SERVER["HTTP_HOST"])) {

    //If the execution is made using direct arguments.
    if (isset($argv[1])) {

        //If one argument is provided, then exit.
        if ($argc < 3) {

            exit("\n\nExiting: Please make sure you enter both the columns "
                    . "and rows numbers\n\n");

          //Otherwise, if both arguments are provided, proceed.
        } else {

            $arguments = "arg1=" . $argv[1] . "&arg2=" . $argv[2];
            parse_str($arguments, $_POST);

        }

        //Otherwise, if the execution is made without passing direct arguments.
    } else {

        //Prompt for user input of the number of columns.
        echo "\n\nPlease enter the desired columns: ";
        $handle1 = fopen("php://stdin", "r");
        $entry1 = fgets($handle1);

        //Prompt for user input of the number of rows.
        echo "\n\nPlease enter the desired rows: ";
        $handle2 = fopen("php://stdin", "r");
        $entry2 = fgets($handle2);

        /* Put both arguments in a string and parses the latter 
         * into variables inside $_POST.
         */
        $arguments = "arg1=" . $entry1 . "&arg2=" . $entry2;
        parse_str($arguments, $_POST);
    }

    //If the execution is  made via browser.
} else {

    // Start the session for the HTML version.
    session_start();

    require_once 'BuildTable.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $rows_parameter = $_POST ['height'];
        $columns_parameter = $_POST ['width'];

        /* Call a function on another page that does the multiplication table
         * generation process.
         */
        $result = generateTableHtml($rows_parameter, $columns_parameter);

        /* A global variable to hold the result so it can be accessed
         * on index page.
         */
        $_SESSION['result'] = $result;

        /* Ending the session as soon as all changes to session variables
         * are done.
         */
        session_write_close();

        //Redirect to index.php
        header("location: index.php");
        exit();
    }
}
