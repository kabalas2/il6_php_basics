<?php

namespace Core\Interfaces;

interface ModelInterface
{

    public function load(int $id): object;

    public function assignData();

}