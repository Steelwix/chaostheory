<?php

namespace App\Controller;

use League\Csv\Reader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScriptController extends AbstractController
{
    const REFERENCE = "reference";
    const NAME = "name";
    const TYPE = "type";
    const VALUE = "value";
    #[Route('/script', name: 'app_script')]
    public function script(): Response
    {

        set_time_limit(0);
        ignore_user_abort(true);
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $path = '../mlgpoint.xlsx';
        $database = [];
        $i = 0;
        $type = ucfirst(pathinfo($path, PATHINFO_EXTENSION));

        $reader = IOFactory::load($path);
        $sheet = $reader->getActiveSheet();
        $lignes = $sheet->toArray();
        $sql = "";
        $users = [];
        foreach ($lignes as $ligne) {
            if ($i ==0 ) {
                $i++;
                continue;
            }
            $sql .= "UPDATE RankData SET warrantCount = '" . $ligne[1] . "' WHERE user_id = $ligne[0];
                ";
            $i++;
        }

//            $file = fopen('../output.csv', 'w');
//            $line = ["User", "result",];
//            fputcsv($file, $line, ';');
//            foreach ($databases as $user => $value){
//                $line = [$user, $value];
//                fputcsv($file, $line, ';');
//            }
//            fclose($file);
//
            $file = '../sql.txt';
            file_put_contents($file, $sql);
//
        dd("OVER");
    }
}
