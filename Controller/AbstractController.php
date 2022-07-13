<?php
namespace App\Controller;

use App\Core\Database\UserManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Abstract controller from which other controllers will extend
 */
abstract class AbstractController
{
    private $_loader;
    protected $render; 

    public function __construct(){ 
        // where are the templates ?
        $this->_loader = new FilesystemLoader(ROOT.'/View'); 
        
        // setting up the twig environment 
        $this->render = new Environment($this->_loader, [
            'debug' => true, // allow dump()
        ]); 

        $this->render->addExtension(new \Twig\Extension\DebugExtension()); // allow dump()

        // the name of the site
        $this->render->addGlobal('sitename', SITENAME);

        // where are the assets ?
        $this->render->addGlobal('assets_path', ASSETS_PATH);

        // keep the http_referer
        if(isset($_SERVER['HTTP_REFERER'])) {
            $this->render->addGlobal('http_referer', $_SERVER['HTTP_REFERER']);   
        } else{
            $this->render->addGlobal('http_referer', null);
        }
        
    }

}
