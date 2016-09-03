<?php

if (get_query('page') == 'map') {

    include "templates/map.template.php";

} else if (get_query('page') == 'input') {

    include "templates/input.template.php";

} else {

    include "templates/config.template.php";

}