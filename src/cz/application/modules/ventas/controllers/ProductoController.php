<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producto
 *
 * @author Administradores1
 */
class Ventas_ProductoController extends App_Controller_Action {
    
    protected $_producto;


    public function init() {
        parent::init();
        $this->_producto = new Application_Model_Producto();
        
    }


    public function indexAction(){
        $this->log->debug('Hola!!!');
        
        $form = new Application_Form_Producto();
        
        if ($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            
            if($isValid){
                
                //
            }
        }
        
        $paginador = $this->_producto->getPaginator();
        $paginador->setCurrentPageNumber($this->_getParam('page',1));
        $this->view->productos = $paginador;
        
        $this->view->form = $form;
        
    }
    
    public function nuevoAction() {
        $form = new Application_Form_Producto();
        
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);

            if($isValid){
                $this->_producto->insert($form->getValues());
                $this->_helper->flashMessenger('Se insertó correctamente');
                $this->_redirect('/ventas/producto');
            }
            
        }
        $this->view->form = $form;
    }
    
    
    public function verPdfAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $id = $this->_getParam('id');
        $producto = $this->_producto->getDetalle($id);
//        var_dump($producto);exit;

        $pdf = new Zend_Pdf();
        $pdf1 = Zend_Pdf::load(APPLICATION_PATH . '/../templates/producto.pdf');

//        $page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4); // 595 x842
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
//        $pdf->pages[] = $page;
//        $page->setFont($font, 20);$page->drawText('Zend: PDF', 10, 822);
//        $page->setFont($font, 12);$page->drawText('Comentarios', 10, 802);
//        $pdfData = $pdf->render();

        $page = $pdf1->pages[0];
        $page->setFont($font, 12);
        $page->drawText($producto['producto'], 116, 639);
        $page->drawText($producto['precio'], 116, 607);
        $page->drawText($producto['categoria'], 116, 575);
        $page->drawText($producto['fabricante'], 116, 543);
        $page->drawText('zEND', 200, 200);
        $pdfData = $pdf1->render();


        $this->_response->setHeader('Content-type', 'application/x-pdf');
        $this->_response->setHeader('Content-Disposition', 'inline; filename=PRODUCTO_'.  str_pad($id, 6, '0', STR_PAD_LEFT).'.pdf');
        
        $this->_response->appendBody($pdfData);

    }        
    
    public function verAction(){
        if($this->_request->isXmlHttpRequest()){
            $this->_helper->layout->disableLayout();
        }
        $this->view->producto = $this->_producto->getDetalle($this->_getParam('id'));
    }
    
    public function verDomPdfAction(){
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $id = $this->_request->getParam('id');
        $this->view->producto = $this->_producto->getDetalle($id);
        $html = $this->view->render('producto/ver.phtml');
        
        
        require_once(APPLICATION_PATH . "/../library/Dompdf/dompdf_config.inc.php");
        
        $pdf = new DOMPDF();
        $pdf->set_paper('8.5x11','portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('report.pdf'); //->output()
        
    }
    
}

