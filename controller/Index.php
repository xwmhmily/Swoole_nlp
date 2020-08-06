<?php
/**
 * Index Controller
 */

class C_Index extends Controller {

    private $m_user;
    private $m_news;
    
    function __construct(){
    	$this->m_user = $this->load('User');
        $this->m_news = $this->load('News');
    }

    // http index 就写这里
    // URL: http://192.168.1.31:9502/?hello=world
    public function index(){
        return 'Welcome to '.APP_NAME.' http server';
    }
}