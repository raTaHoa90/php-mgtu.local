<?php
namespace lib;

class View {
    private function loadPage($path, $pages = []){
        $content = file_get_contents(config('app.paths.templates','views')."/$path.php");
        if(count($pages))
            $content = strtr($content, $pages);
        $lines = explode(PHP_EOL, $content);
        $line = explode(' ', array_shift($lines));
        if($line[0] == '@extend'){
            $pages['{{'.$line[1].'}}'] = implode(PHP_EOL, $lines);
            return $this->loadPage($line[2], $pages);
        }
        return $content; 
    }

    function render($page, $vars = []){
        $page = $this->loadPage($page);

        $name = 'temp_'.date('Y_m_d_h_i_s').rand(100000000, 999999999);
        $path = config('app.paths.temp','temp')."/$name.php";
        file_put_contents($path, $page);

        extract($vars);
        /*
            $vars = ['key1' => 123, 'key2' => 'test'];
            =>
            $key1 = 123;
            $key2 = 'test';
        */
        include $path;
        unlink($path);
    }

    function redirect(string $url, int $code = 302){
        header("Location: $url");
        http_response_code($code);
        exit;
    }

    function back(){
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}