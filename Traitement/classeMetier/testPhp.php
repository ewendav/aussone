<?php
use PHPUnit\Framework\TestCase;
include_once('Traitement/classMetier/metierAdherent.php');
include_once('Traitement/classMetier/metierEntraineur.php');

class DTest extends TestCase
{

    private metierAdherent $test;
    private metierEquipe $Equipe;
    private metierEntraineur $Entraineur;
     /**
     * @before
     */
    public function initTestEnvironment()
    {
        $Entraineur = new metierEntraineur(1, "e","e","e");
        $Equipe = new metierEquipe($Entraineur, "e",1,2,3,'e',1);
        $test = new metierAdherent($Equipe, 2, "Axel", "Renard", 19, "H", "arenard", "test");
    }

    public function testClasseMetierAdherent()
    {
        $this->test->nom;

    }
}
