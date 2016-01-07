<?php

namespace Controller;

use Hasty\Controller;
use Hasty\Helper;
use Hasty\Session;
use Model\User;

class Main extends Controller
{

    /**
     * @route GET /
     */
    public function index()
    {
        $user = Session::get('user');

        $installed = json_decode(
            file_get_contents(ROOT . '/vendor/composer/installed.json'));
        $installedModule = [];
        foreach ($installed as $i) {
            $installedModule[] = [
                'name' =>$i->name,
                'version'=>$i->version
            ];
        }

        return $this->render('main/index.twig', [
            'name' => $user['name'],
            'installed_module' => $installedModule,
            'app_root' => ROOT,
            'web_root' => getcwd(),
            'phpversion' => phpversion(),
        ]);
    }
}
