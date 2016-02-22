<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 21/02/2016
 * Time: 19:36
 */

namespace LotrBundle\Service;


class MapGenerator
{
    public function generate($trip)
    {
        header ("Content-type: image/png");
        $image = imagecreatefromjpeg(__DIR__ . '/../Resources/maps/mapLegendeEtGrid.jpg');
        $color = [
            'aragorn' => imagecolorallocate($image, 0x68, 0x0E, 0x0E),
            'boromir' => imagecolorallocate($image, 0xED, 0xE6, 0x00),
            'frodon' => imagecolorallocate($image, 0xDD, 0x00, 0x2A),
            'gandalf' => imagecolorallocate($image, 0x8F, 0x00, 0xDB),
            'gimli' => imagecolorallocate($image, 0x00, 0x10, 0xDD),
            'legolas' => imagecolorallocate($image, 0x54, 0x97, 0x9D),
            'merry' => imagecolorallocate($image, 0x49, 0xD3, 0x00),
            'pippin' => imagecolorallocate($image, 0x00, 0xAE, 0xD6),
            'sam' => imagecolorallocate($image, 0xDD, 0x78, 0x00),
        ];
        $oldCoordX = null;
        $oldCoordY = null;

        foreach ($trip as $item) {
//            echo $item->getCharacter()->getSlug();
            ImageFilledEllipse ($image, $item->getCoordx() * 10, $item->getCoordy() * 10, 7, 7, $color[$item->getCharacter()->getSlug()]);
            if($oldCoordX && $oldCoordX != -1 && $item->getCoordx() != -1)
            {
                ImageLine ($image, $item->getCoordx() * 10, $item->getCoordy() * 10, $oldCoordX * 10, $oldCoordY * 10, $color[$item->getCharacter()->getSlug()]);
            }
            $oldCoordX = $item->getCoordx();
            $oldCoordY = $item->getCoordy();
        }
//        echo($trip)
        //var_dump($trip);
//        die();


        imagepng($image);
        die('HEU ?');
    }
}