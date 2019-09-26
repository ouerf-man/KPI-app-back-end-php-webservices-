<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 22/09/2019
 * Time: 20:20
 */


// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// get database connection

include_once '../../includes/connextionBD.php';
// instantiate product object
include_once '../objects/Article.php';
include_once '../objects/Deputie.php';

$db = connextionBD::getInstance();
if (!isset($_GET['dep'])) {
    http_response_code(404);
    die("more data required");
}

$art = new Article($db);
$dep = new Deputie($db);
$dep->id = $_GET['dep'];

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
    $art->cat = $cat;

    $stmt = $art->getAll();

    if ($stmt->rowCount() == 0) {
        http_response_code(404);

        // tell the user no categories found
        echo json_encode(
            array("message" => "No articles found.")
        );
    } else {
        $articles = array();
        while ($row = $stmt->fetch()) {
            array_push($articles, $row['id']);
        }

        $stmt = $dep->getAvg('votes_articles');
        $num = $stmt->rowCount();
// check if more than 0 record found
        if ($num > 0) {
            $result = array();

            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);

                $votes = json_decode($attributes, true);
                foreach ($votes as $key => $item) {
                    if (in_array(intval($key), $articles)) {
                        $arr = array();
                        $art->id = intval($key);
                        $stmt = $art->getOne();
                        if ($stmt->rowCount() > 0) {
                            $row = $stmt->fetch();
                            $arr['title'] = $row['title'];
                            $arr['pdf'] = "http://" . $_SERVER['SERVER_NAME'] . "/" . $row['file'];
                            $arr['vote'] = intval($item);
                            array_push($result, $arr);
                        }
                    }
                }
            }

            // set response code - 200 OK
            http_response_code(200);
            // show categories data in json format
            echo json_encode(array(
                "articles" => $result,
            ));
        } else {

            // set response code - 404 Not found
            http_response_code(404);

            // tell the user no categories found
            echo json_encode(
                array("message" => "No data found.")
            );
        }
    }

}
else{
    $stmt = $art->getAllNoFiltrage();

    if ($stmt->rowCount() == 0) {
        http_response_code(404);

        // tell the user no categories found
        echo json_encode(
            array("message" => "No articles found.")
        );
    } else {
        $articles = array();
        while ($row = $stmt->fetch()) {
            array_push($articles, $row['id']);
        }

        $stmt = $dep->getAvg('votes_articles');
        $num = $stmt->rowCount();
// check if more than 0 record found
        if ($num > 0) {
            $result = array();

            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);

                $votes = json_decode($attributes, true);
                foreach ($votes as $key => $item) {
                    if (in_array(intval($key), $articles)) {
                        $arr = array();
                        $art->id = intval($key);
                        $stmt = $art->getOne();
                        if ($stmt->rowCount() > 0) {
                            $row = $stmt->fetch();
                            $arr['title'] = $row['title'];
                            $arr['pdf'] = "http://" . $_SERVER['SERVER_NAME'] . "/" . $row['file'];
                            $arr['vote'] = intval($item);
                            array_push($result, $arr);
                        }
                    }
                }
            }

            // set response code - 200 OK
            http_response_code(200);
            // show categories data in json format
            echo json_encode(array(
                "articles" => $result,
            ));
        } else {

            // set response code - 404 Not found
            http_response_code(404);

            // tell the user no categories found
            echo json_encode(
                array("message" => "No data found.")
            );
        }
    }
}