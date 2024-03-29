<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    public function _initView() {

        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype(Zend_View_Helper_Doctype::XHTML1_STRICT);

        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->headTitle('CZ');
        $view->headTitle('Home');
        $view->headTitle()->setSeparator(' | ');
        $view->headMeta()->appendName('keywords','zend, curso zend, zend framework');
        $view->headLink()->appendStylesheet('/css/global.css');
        $view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js','text/javascript');
        $view->headScript()->appendFile('/js/global.js','text/javascript');
        $view->headScript()->appendFile(
                '/js/fixie.js',
                'text/javascript',
                array('conditional'=>'lt IE 7')
        );
        
    }
    
    public function _initRoutes(){
        
        $rutas = array(
            'cntcto' => new Zend_Controller_Router_Route(
                'contact-us',
                array(
                    'module' => 'temas',
                    'controller' => 'index',
                    'action' => 'contacto'
                )
            ),
            'slugfab' => new Zend_Controller_Router_Route(
                'fab/:slug',
                array(
                    'module' => 'ventas',
                    'controller' => 'fabricante',
                    'action' => 'ver',
                    'slug'=>':slug'
                )
            ),
            'ver-post' => new Zend_Controller_Router_Route(
                'post/:id-:slug',
                array(
                    'module' => 'blog',
                    'controller' => 'post',
                    'action' => 'ver',
                    'postId' => ':id',
                    'postSlug' => ':slug'

                )
            )
        );
        
        $this->frontController->getRouter()->addRoutes($rutas);

    }


}

