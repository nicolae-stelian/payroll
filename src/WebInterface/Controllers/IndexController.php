<?php


namespace WebInterface\Controllers;


class IndexController
{
    public function index()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . "/../views/");
        $twig = new \Twig_Environment($loader);
        echo $twig->render('base.twig', array('name' => 'world!!'));
    }

    public function tdd()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . "/../views/");
        $twig = new \Twig_Environment($loader);
        echo $twig->render('base.twig', array('name' => 'TDD!!'));
    }

} 