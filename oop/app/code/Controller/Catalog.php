<?php

namespace Controller;

use Core\AbstractController;
use Helper\FormHelper;
use Helper\Logger;
use Helper\Url;
use Model\Ad;
use Core\Interfaces\ControllerInterface;
use Model\Rating;
use Model\SavedAd;

class Catalog extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $this->data['count'] = Ad::count();
        $page = 0;
        if (isset($_GET['p'])) {
            $page = (int)$_GET['p'] - 1;
        }

        $this->data['ads'] = Ad::getAllAds($page * 2, 2);
        $this->render('catalog/all');
    }

    public function add()
    {

        if (!isset($_SESSION['user_id'])) {
            Url::redirect('');
        }
        $form = new FormHelper('catalog/create', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas'
        ]);

        $form->textArea('description', 'Aprasymas');
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina'
        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai'
        ]);
        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Paveiksliukas'
        ]);

        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');

    }

    public function create()
    {
        $slug = Url::slug($_POST['title']);
        while (!Ad::isValueUnic('slug', $slug)) {
            $slug = $slug . rand(0, 100);
        }
        $ad = new Ad();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setImage($_POST['image']);
        $ad->setActive(1);
        $ad->setSlug($slug);
        $ad->setViews(0);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->save();
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user_id'])) {
            Url::redirect('');
        }
        $ad = new Ad();
        $ad->load($id);

        if ($_SESSION['user_id'] != $ad->getUserId()) {
            Url::redirect('');
        }

        $form = new FormHelper('catalog/update', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas',
            'value' => $ad->getTitle()
        ]);

        $form->input([
            'name' => 'id',
            'type' => 'hiden',
            'value' => $ad->getId()

        ]);

        $form->textArea('description', $ad->getDescription());
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina',
            'value' => $ad->getPrice()
        ]);
        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Kaina',
            'value' => $ad->getImage()
        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai',
            'value' => $ad->getYear()
        ]);

        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');
    }

    public function update()
    {
        $adId = $_POST['id'];
        $ad = new Ad();
        $ad->load($adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setImage($_POST['image']);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->save();
    }

    public function show($slug)
    {
        $ad = new Ad();

        if ($ad->loadBySlug($slug) === null) {
            $this->render('parts/errors/error404');
            return;
        }
        $newViews = (int)$ad->getViews() + 1;
        $ad->setViews($newViews);
        $ad->save();

        $form = new FormHelper('catalog/commentsave', 'POST');
        $form->input([
            'type' => 'hidden',
            'name' => 'ad_id',
            'value' => $ad->getId()
        ]);
        $form->textArea('comment', 'Komentaras...');
        $form->input([
            'type' => 'submit',
            'name' => 'ok',
            'value' => 'Komentuok atsakingai'
        ]);
        $this->data['rated'] = false;
        $rate = new Rating();
        $isRateNull = $rate->loadByUserAndAd($_SESSION['user_id'], $ad->getId());
        if ($isRateNull !== null) {
            $this->data['rated'] = true;
            $this->data['user_rate'] = $rate->getRating();
        }

        $ratings = Rating::getRatingsByAd($ad->getId());
        $sum = 0;
        foreach ($ratings as $rate) {
            $sum += $rate['rating'];
        }

        $this->data['ad_rating'] = 0;
        $this->data['rating_count'] = count($ratings);
        if ($sum > 0) {
            $this->data['ad_rating'] = $sum / $this->data['rating_count'];
        }
        if ($this->isUserLoged()) {
            $savedAd = new SavedAd();
            $savedAd = $savedAd->loadByUserAndAd($_SESSION['user_id'], $ad->getId());
            $this->data['saved_ad'] = $savedAd;
        }
        $this->data['comment_form'] = $form->getForm();
        $this->data['ad'] = $ad;
        $this->data['title'] = $ad->getTitle();
        $this->data['meta_description'] = $ad->getDescription();

        $this->render('catalog/single');


    }

    public function commentsave()
    {

    }

    public function rate()
    {
        $rate = new Rating();
        $rate->loadByUserAndAd($_SESSION['user_id'], $_POST['ad_id']);
        $rate->setUserId((int)$_SESSION['user_id']);
        $rate->setAdId((int)$_POST['ad_id']);
        $rate->setRating((int)$_POST['rate']);
        $rate->save();
        echo '<pre>';
        print_r($_POST);
        print_r($rate);
    }

    public function favorite()
    {
        print_r($_POST);
        $adId = $_POST['ad_id'];
        $savedAd = new SavedAd();
        $saved = $savedAd->loadByUserAndAd($_SESSION['user_id'], $adId);
        if ($saved !== null) {
            $saved->delete();
        } else {
            $savedAd->setAdId($adId);
            $savedAd->setUserId($_SESSION['user_id']);
            $savedAd->save();
        }
    }
}

