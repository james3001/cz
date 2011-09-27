<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * @var Bisna\Application\Container\DoctrineContainer
     */
    protected $doctrine;
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    /**
     * @var Models\Entity\Repository\CategoriaRepository
     */
    protected $_categoria;
    /**
     * @var Models\Entity\Repository\FabricanteRepository
     */
    protected $_fabricante;
    /**
     * @var Models\Entity\Repository\ProductoRepository
     */
    protected $_producto;

    public function init()
    {
        $this->doctrine = Zend_Registry::get('doctrine');
        $this->em = $this->doctrine->getEntityManager();
        $this->_categoria = $this->em->getRepository('\Models\Entity\Categoria');
        $this->_fabricante = $this->em->getRepository('\Models\Entity\Fabricante');
        $this->_producto = $this->em->getRepository('\Models\Entity\Producto');

    }

    public function indexAction()
    {
        if (!count($this->_categoria->findAll())) {
            $this->_redirect('/index/fixtures');
        }


        $this->view->categorias = $this->_categoria->findAll();
        $this->view->fabricantes = $this->_fabricante->findAll();
        $this->view->productos = $this->_producto->findAll();

    }

    public function fixturesAction()
    {
        $c1 = new \Models\Entity\Categoria();
        $c1->setName('categoria 1');
        $this->em->persist($c1);

        $c2 = new \Models\Entity\Categoria();
        $c2->setName('categoria 2');
        $this->em->persist($c2);

        $c3 = new \Models\Entity\Categoria();
        $c3->setName('categoria 3');
        $this->em->persist($c3);

        // crando 12 fabricantes aleatoriamente
        foreach(range(1,12) as $n  ){
            $f = 'f'.$n;
            $$f = new \Models\Entity\Fabricante();
            $$f->setName('Fabricante '.$n);
            $cat = 'c'.rand(1,3);
            $$f->setCategoria($$cat);
            $this->em->persist($$f);
        }

        //creando 50 productos aleatoriamente
        foreach(range(1,50) as $n  ){
            $p = 'p'.$n;
            $$p = new \Models\Entity\Producto();
            $$p->setName('Producto '.$n);
            $fab = 'f'.rand(1,12);
            $$p->setFabricante($$fab);
            $this->em->persist($$p);
        }

        $this->em->flush();
        $this->_redirect('/');

    }

    public function catalogo1Action(){
        $this->view->fabricantes = $this->_fabricante->findAll();
        $id = $this->_getParam('id', false);
        if($id){
            $this->view->id = $id;
            $this->view->fabricante = $this->_fabricante->find($id);
        }
    }

    
    public function catalogo2Action(){
        $this->view->fabricantes = $this->_fabricante->findAll();

        $id = $this->_getParam('id', false);
        if($id){
            $this->view->id = $id;
            $this->view->fabricante = $this->_fabricante->find($id);

            $qb = $this->em->createQueryBuilder()
                ->select('f, p')
                ->from("\\Models\\Entity\\Fabricante", 'f')
                ->leftJoin('f.Productos', 'p')
                ->orderBy('p.name', 'ASC')
                ->where('p.id > 25')
                ->andWhere('f.id = '.$id )
                ;
            $q = $qb->getQuery();
            $this->view->FabricantesDeProductos25 = $q->execute();
            $this->view->FabricantesDeProductos25Array = $q->getArrayResult();
        }
    }

    public function catalogo3Action(){
        $this->view->fabricantes = $this->_fabricante->findAll();

        $id = $this->_getParam('id', false);
        if($id){
            $this->view->id = $id;
            $this->view->fabricante = $this->_fabricante->find($id);

            $qb = $this->em->createQueryBuilder()
                ->select('p, f')
                ->from("\\Models\\Entity\\Producto", 'p')
                ->leftJoin('p.Fabricante', 'f')
                ->orderBy('p.name', 'ASC')
                ->where('p.id > 25')
                ->andWhere('f.id = '.$id )
                ;
            $q = $qb->getQuery();
            $this->view->Productos25 = $q->execute();
            $this->view->Productos25Array = $q->getArrayResult();
        }
    }

}

