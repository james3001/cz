<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//use application\models;

/**
 * Description of TestController
 *
 * @author eanaya
 */
class TestController extends Zend_Controller_Action {

    /**
     * @var Bisna\Application\Container\DoctrineContainer
     */
    protected $doctrine;
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function init()
    {
        $this->doctrine = Zend_Registry::get('doctrine');
        $this->em = $this->doctrine->getEntityManager();
        $this->_article = $this->em->getRepository('application\models\Article');

    }

    public function indexAction(){
        
    }

}
?>
