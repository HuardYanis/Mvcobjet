<?php 
require_once "vendor/autoload.php";

use Yanis\MvcObjet\controllers\ActorController; 
use Yanis\MvcObjet\controllers\GenreController; 
use Yanis\MvcObjet\controllers\DirecteurController; 
use Yanis\MvcObjet\controllers\FilmController; 

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/src/views');
$twig = new Environment($loader, ['cache' => false, 'debug' => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$ac = new ActorController($twig);
$fc = new FilmController($twig);


$gc = new GenreController($twig);
$dc = new DirecteurController($twig);

$base  = dirname($_SERVER['PHP_SELF']);

if(ltrim($base, '/')){ 
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

$route = new \Klein\Klein();

$route->respond('GET','/', function() use($ac) {
    echo "coucou"; 
});
$route->respond('GET','/acteurs', function() use($ac) {
   $ac->listeActeurs(); 
   

});
$route->respond('GET','/acteur/[:id]', function($req,$res) use($ac) {
     $ac->getOneActor($req->id);
    
});

$route->respond('GET','/genres', function() use($gc) {
    $gc->listeGenres(); 



});

$route->respond('GET','/genre/[:id]', function($req,$res) use($gc) {
    $gc->getOneGenre($req->id);
     
});
$route->respond('GET','/directeurs', function() use($dc) {
    $dc->listeDirecteurs(); 

});

$route->respond('GET','/directeur/[:id]', function($req,$res) use($dc) {
    $dc->getOneDirecteur($req->id);
     
});

$route->respond('GET','/film/[:id]', function($req,$res) use($fc) {
    $fc->getOneFilm($req->id);
     
});

$route->respond('GET','/addacteur', function() use($ac) {
    $ac->addActor();
     
});

$route->respond('POST','/recordactor', function($req) use($ac) {
    $ac->recordActor($req->paramsPost());
     
});

$route->respond('GET','/addfilm', function() use($fc) {
    $fc->addFilm();
     
});

$route->respond('POST','/recordfilm', function($req) use($fc) {
  $file =$req->files()->all();

 
    $fc->recordFilm($req->paramsPost(), $file);
     
});


$route->dispatch();

?>