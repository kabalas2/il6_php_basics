<?php

namespace Controller;

use Core\AbstractController;
use Helper\Url;
use Model\Ad;

class Import extends AbstractController
{
    public function execute()
    {
        $csvPath = PROJECT_ROOT_DIR . '/var/import/ads.csv';
        if (($handle = fopen($csvPath, "r")) !== FALSE) {
            $row = 1;
            $keys = [];
            $adsArray = [];
            while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                if ($row == 1) {
                    $keys = $data;
                } else {
                    $adsArray[$row] = [];
                    foreach ($data as $key => $element) {
                        $adsArray[$row][$keys[$key]] = $element;
                    }
                }

                $row++;
            }
            foreach ($adsArray as $adData) {
                $ad = new Ad();
                $slug = Url::slug($adData['title']);
                while (!Ad::isValueUnic('slug', $slug)) {
                    $slug = $slug . rand(0, 100);
                }
                $ad->setTitle($adData['title']);
                $ad->setDescription($adData['description']);
                $ad->setYear($adData['years']);
                $ad->setManufacturerId(1);
                $ad->setModelId(1);
                $ad->setPrice($adData['price']);
                $ad->setImage($adData['image']);
                $ad->setActive(1);
                $ad->setViews(0);
                $ad->setSlug($slug);
                $ad->setTypeId(1);
                $ad->setUserId(10);
                $ad->save();
            }
            unlink($csvPath);
        } else {
            echo 'Nera tinkamo csv failo.';
        }
    }
}