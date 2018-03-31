<?php

namespace Tests\SNT\GestionEmployerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployersControllerTest extends WebTestCase
{
    /**
     * @test
     */
    /*public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gestion/employer/index');
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::indexAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h1:contains("Bienvenue dans le portail employer")'));

        $this->assertCount(1, $crawler->filter('a:contains("Lister les employers")'));
        $this->assertCount(1, $crawler->filter('a:contains("Ajouter un employer")'));
        $this->assertCount(1, $crawler->filter('a:contains("Rechercher un employer")'));

        $list = $crawler->filter('a:contains("Lister les employers")')->eq(0)->link();
        $add = $crawler->filter('a:contains("Ajouter un employer")')->eq(0)->link();
        $search = $crawler->filter('a:contains("Rechercher un employer")')->eq(0)->link();

        $client->click($list);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::allAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->click($add);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::saveAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->click($search);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::searchAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }*/

    /**
     * @test
     */
    /*public function testSave()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get("doctrine")->getManager();

        $crawler = $client->request('GET', '/gestion/employer/save');
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::saveAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Enregistrer')->form();
        $client->submit($form, array(
            'snt_gestionemployerbundle_employers[matricule]' => 'AA125DCOQ',
            'snt_gestionemployerbundle_employers[nomcomplet]' => 'Fallou Ndiaye',
            'snt_gestionemployerbundle_employers[birthday]' => '1985/10/17',
            'snt_gestionemployerbundle_employers[idservice]' => 1
        ));

        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::saveAction", $client->getRequest()->attributes->get('_controller'));

        $newemployer = $em->getRepository("SNT\GestionEmployerBundle\Entity\Employers")->findBy(array('matricule' => 'AA125DCOQ'));

        $this->assertCount(6, $newemployer);

        $this->assertTrue($client->getResponse()->isRedirect('/gestion/employer/all'));
    }*/

    /**
     * @test
     */
    /*public function testAll()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get("doctrine")->getManager();

        $crawler = $client->request('GET', '/gestion/employer/all');
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::allAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertCount(6, $crawler->filter('tr.employer'));

        $edit = $crawler->filter('a:contains("Modifier")')->eq(0)->link();
        $client->click($edit);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::editAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $supp = $crawler->filter('a:contains("Supprimer")')->eq(0)->link();
        $client->click($supp);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::removeAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }*/

    /**
     * @test
     */
    public function testEditemploye()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get("doctrine")->getManager();

        $crawler = $client->request('GET', '/gestion/employer/edit/1');
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::editAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $cancel = $crawler->filter('a:contains("Annuler")')->eq(0)->link();
        $client->click($cancel);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::allAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Enregistrer')->form();

        $this->assertContains('AA125DCOQ', $client->getResponse()->getContent());
        $this->assertContains('Ousmane Ndiaye', $client->getResponse()->getContent());
        $this->assertContains('1994/09/18', $client->getResponse()->getContent());

        $client->submit($form, array(
            'snt_gestionemployerbundle_employers[matricule]' => 'AA125DCOQ',
            'snt_gestionemployerbundle_employers[nomcomplet]' => 'Ousmane Ndiaye',
            'snt_gestionemployerbundle_employers[birthday]' => '1998/09/18',
            'snt_gestionemployerbundle_employers[idservice]' => 1
        ));

        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::editAction", $client->getRequest()->attributes->get('_controller'));

        $newemployer = $em->getRepository("SNT\GestionEmployerBundle\Entity\Employers")->findBy(array('matricule' => 'AA125DCOQ','nomcomplet' => 'Ousmane Ndiaye','birthday' => '1998/09/18'));

        $this->assertCount(1, $newemployer);

        $this->assertTrue($client->getResponse()->isRedirect('/gestion/employer/all'));
    }

    /**
     * @test
     */
    /*public function testRemoveemploye()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get("doctrine")->getManager();

        $crawler = $client->request('GET', '/gestion/employer/remove/1');
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::removeAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $cancel = $crawler->filter('a:contains("Annuler")')->eq(0)->link();
        $client->click($cancel);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::allAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Supprimer')->form();

        $this->assertContains('AA125DCOQ', $client->getResponse()->getContent());
        $this->assertContains('Ousmane Ndiaye', $client->getResponse()->getContent());
        $this->assertContains('1998/09/18', $client->getResponse()->getContent());

        $client->submit($form);

        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::removeAction", $client->getRequest()->attributes->get('_controller'));

        $newemployer = $em->getRepository("SNT\GestionEmployerBundle\Entity\Employers")->findBy(array('matricule' => 'AA125DCOQ'));

        $this->assertCount(0, $newemployer);

        $this->assertTrue($client->getResponse()->isRedirect('/gestion/employer/all'));
    }*/

    /**
     * @test
     */
    /*public function testSearch()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get("doctrine")->getManager();

        $crawler = $client->request('GET', '/gestion/employer/search');
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::searchAction", $client->getRequest()->attributes->get('_controller'));
        echo $client->getResponse()->getContent();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Rechercher')->form();
        $client->submit($form, array('matricule' => 'AA125DCOQ'));

        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::searchAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('tr.employer'));

        $this->assertContains('AO44575DC', $client->getResponse()->getContent());
        $this->assertContains('Ndeye Anta Sy', $client->getResponse()->getContent());
        $this->assertContains('1997/07/19', $client->getResponse()->getContent());

        $edit = $crawler->filter('a:contains("Modifier")')->eq(0)->link();
        $client->click($edit);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::editAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $supp = $crawler->filter('a:contains("Supprimer")')->eq(0)->link();
        $client->click($supp);
        $this->assertEquals("SNT\GestionEmployerBundle\Controller\EmployersController::removeAction", $client->getRequest()->attributes->get('_controller'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }*/
}