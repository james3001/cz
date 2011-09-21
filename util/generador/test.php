<?php

$env = 'testing';
include('app.php');

//$a = new Application_Model_Producto();
//var_dump($a->fetchAll()->toArray());


$cat = new Application_Model_Categoria();
$data = range(1, 200000);

// sin paginador
//foreach ($data as $row) {
//    echo $row. "   ";
//    $cat->insert(array(
//        'nombre' => md5(md5(md5(md5(md5(rand(1, 100)))))),
//        'descripcion' => md5(md5(md5(md5(md5(rand(1, 100)))))),
//        'activo' => rand(0, 1)
//    ));
//}

// con paginador
$p = Zend_Paginator::factory($data);
//$p->getAdapter()->setRowCount(200000);
$p->setItemCountPerPage(5000);
$pages = $p->getPages();
foreach (range($pages->first, $pages->last) as $page) {
    $p->setCurrentPageNumber($page);
    echo PHP_EOL . PHP_EOL . " [[page $page]] " . PHP_EOL;
    foreach ($p as $item) {
        $cat->insert(array(
            'nombre' => md5(md5(rand(1, 100))),
            'descripcion' => md5(md5(rand(1, 100))),
            'activo' => rand(0, 1)
        ));
    }
}
