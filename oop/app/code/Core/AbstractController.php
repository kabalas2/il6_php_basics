<?php

namespace Core;
use Helper\Url;

class AbstractController
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
        $this->data['title'] = 'Srotas24.lt';
        $this->data['meta_description'] = '';
    }

    protected function render($template)
    {
        include_once PROJECT_ROOT_DIR . '/app/design/parts/header.php';
        include_once PROJECT_ROOT_DIR . '/app/design/' . $template . '.php';
        include_once PROJECT_ROOT_DIR . '/app/design/parts/footer.php';
    }

    protected function isUserLoged()
    {
        return isset($_SESSION['user_id']);
    }

    public function url($path, $param = null)
    {
        return Url::link($path, $param);
    }

}