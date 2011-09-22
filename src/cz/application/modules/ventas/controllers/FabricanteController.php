<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaController
 *
 */
class Ventas_FabricanteController extends Zend_Controller_Action {

    protected $_fabricante;
    protected $URL;

    public function init() {
        $this->_fabricante = new Application_Model_Fabricante();
        $this->URL = '/'.$this->getRequest()->getControllerName();
        parent::init();
    }

    public function indexAction() {
        $this->view->fabricantes = $this->_fabricante->fetchAll();
    }
    
//    public function verAction() {
//        $this->view->fabricante = $this->_fabricante->detalle($this->_getParam('id'));
//    }
    
    public function nuevoAction() {

        $form = new Application_Form_Fabricante();
        if($this->_request->isPost() && $form->isValid($this->_request->getPost()) ){
            $fabricante = $form->getValues();
            $fabricante['activo'] = 1;
            $slugger = new App_Filter_Slug(array(
                'field' => 'slug',
                'model' => $this->_fabricante
            ));
            $fabricante['slug'] = $slugger->filter($fabricante['nombre'].".".$fabricante['ruc']);
            $this->_fabricante->insert($fabricante);
            $this->_helper->FlashMessenger('Se agregó un fabricante');
            $this->_redirect($this->URL);
        }
        $this->view->form = $form;
    }
    
    public function verAction(){
        $slug = $this->_getParam('slug','');
        $f = new Application_Model_Fabricante();
        $db = $f->getAdapter();
        if($slug!=''){
            $where = $db->quoteInto('slug = ?', $slug);
        }else{
            $where = $db->quoteInto('id = ?', $this->_getParam('id'));
        }
        $sql = $f->getAdapter()
                ->select()
                ->from('fabricante')
                ->where($where);
        
        $this->view->fabricante = $f->getAdapter()->fetchRow($sql);
        
    }

    public function editarAction() {
        $where = 'id='.$this->_getParam('id');
        $fabricante = $this->_fabricante->fetchRow($where);
        $form = new Application_Form_Fabricante();
        if(!is_null($fabricante)){
            if($this->_request->isPost() && $form->isValid($this->_request->getPost()) ){
                $this->_fabricante->update($form->getValues(),$where);
                $this->_helper->FlashMessenger('Se modificó un fabricante');
                $this->_redirect($this->URL);
            }
            $form->setDefaults($fabricante->toArray());
            $this->view->form = $form;
        }else{
            $this->_helper->FlashMessenger('No existe ese fabricante');
            $this->_redirect($this->URL);
        }
    }
    
    public function borrarAction() {
        $id = $this->_request->getParam('id');
        $this->_fabricante->delete('id='.$id);
        $this->_helper->FlashMessenger('Fabricante borrado');
        $this->_redirect($this->URL);
    }

    public function activarAction() {
        $id = $this->_request->getParam('id');
        $this->_fabricante->update(array('activo'=>1),'id='.$id);
        $this->_helper->FlashMessenger('Fabricante activado');
        $this->_redirect($this->URL);
    }
    
    public function desactivarAction() {
        $id = $this->_request->getParam('id');
        $this->_fabricante->update(array('activo'=>0),'id='.$id);
        $this->_helper->FlashMessenger('Fabricante desactivado');
        $this->_redirect($this->URL);
    }


}
