<?php

// Enabling strict typing feature.
declare(strict_types=1);

// If the execution is not made via browser ( i.e. otherwise through PHP CLI).
if (!isset($_SERVER['HTTP_HOST'])) {

    include 'ProcessTable.php';
    require_once 'BuildTable.php';

    $columns_parameter = $_POST['arg1'];
    $rows_parameter = $_POST['arg2'];
    $result = generateTable($rows_parameter, $columns_parameter);

    // Use the ANSI escape sequences to control the colours on PHP CLI.
    echo "\n\n" . chr(27) . "[30;103m" . "The Requested Table:" . chr(27)
    . "[0m\n\n";

    print_r($result);
    exit(0);

    // Otherwise, if the execution is made through browser,
} else {

    // Start the session for HTML version.
    session_start();

}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Multiplication_Table</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/Styles.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div class="container">

            <div class="split" id="left">

                <form name="creation" id="creation" 
                      action="ProcessTable.php" method="post">

                    <fieldset>
                        <legend><b> Table Customisation </b></legend>

                        <div class="form-group adjust">
                            <label for="width">Columns:</label>
                            <input type="text" name="width" id="width"/>
                        </div>

                        <div class="form-group adjust">
                            <label for="height">Rows: </label>
                            <input type="text" name="height" id="height"/>
                        </div>

                        <button type="submit" class="btn btn-success" 
                                name="Submit">Generate</button>

                    </fieldset>

                </form>

                <p id="CSS_Validator">

                    <a href="http://jigsaw.w3.org/css-validator/check/referer">

                        <img id="CSS"
                             src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                             alt="Valid CSS!" />
                    </a>

                </p>

            </div>


            <div class="split">

                <fieldset>
                    <legend><b>Result</b></legend>

                    <div class="Notes">

                        <?php

                        echo "<pre>";

                            echo nl2br("The Requested Table:\n\n");
                            print_r($_SESSION['result']);

                        echo "</pre>";

                        // Unregister all session variables.
                        session_unset();

                        /**
                         * Destroys all of the data associated
                         *  with the current session.
                         */
                        session_destroy();
                        ?>

                    </div>

                </fieldset>

            </div>

        </div>

    </body>

</html>
