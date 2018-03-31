<?php

namespace SNT\GestionEmployerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use SNT\GestionEmployerBundle\Entity\Employers;
use SNT\GestionEmployerBundle\Form\EmployersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/employer")
 */
class EmployersController extends Controller
{
    /**
     * @Route("/index", name="employer_index")
     */
    public function indexAction()
    {
        return $this->render('GestionBundle:Employers:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/save", name="employer_save")
     * @Method({"GET", "POST"})
     */
    public function saveAction(Request $request)
    {
        $employer = new Employers();

        $form = $this->createForm(EmployersType::class,$employer)->add('save', SubmitType::class, array('label' => 'Enregistrer'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $error = '';

            $matricule = preg_replace('/ /','',$employer->getMatricule());

            if (preg_match('/[^A-Z0-9 ]+/i',$matricule) || strlen($matricule) <= 5 )
            {
                $error ="Veuillez saisir un matricule correcte </br>";
            }

            $nomcomplet = preg_replace('/ /','',$employer->getNomcomplet());

            if (preg_match('/[^a-zA-Z ]+/i',$nomcomplet) || strlen($nomcomplet) <= 4 )
            {
                $error ="Veuillez saisir un prenom et nom correcte </br>";
            }

            if($error == '')
            {
                $em = $this->getDoctrine()->getManager();
                $l_employer = $em->getRepository('GestionBundle:Employers')->findBy(array('matricule'=>$matricule,'idservice'=>$idservice));
                if($l_employer == null)
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($employer);
                    $em->flush();

                    return $this->render('GestionBundle:Employers:search.html.twig', array(
                        'error'=>$error,
                        'employers'=>$employers
                    ));
                }

                $error = "Désolé un employer ayant le même matricule que vous est dans cette entreprise !";

                return $this->render('GestionBundle:Employers:save.html.twig', array(
                    'error'=>$error
                ));
            }

            return $this->render('GestionBundle:Employers:search.html.twig', array(
                'error'=>$error
            ));

            $lesEmployers = $em->getRepository('GestionBundle:Employers')->findAll();

            return $this->redirectToRoute('employer_all', array('lesEmployers' => $lesEmployers));
        }
        return $this->render('GestionBundle:Employers:save.html.twig', array(
            'form'=> $form->createView()
        ));
    }


    /*public function saveAction(Request $request)
    {
        $employer = new Employers();

        $form = $this->createForm(EmployersType::class,$employer)->add('save', SubmitType::class, array('label' => 'Enregistrer'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employer);
            $em->flush();

            $lesEmployers = $em->getRepository('GestionBundle:Employers')->findAll();

            return $this->redirectToRoute('employer_all', array('lesEmployers' => $lesEmployers));
        }
        return $this->render('GestionBundle:Employers:save.html.twig', array(
            'form'=> $form->createView()
        ));
    }*/

    /**
     * @Route("/search", name="employer_search")
     */
    public function searchAction(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $error = '';
            extract($_POST);

            $matricule = preg_replace('/ /','',$matricule);

            if (preg_match('/[^A-Z0-9 ]+/i',$matricule) || strlen($matricule) <= 5 ) {
                $error ="Veuillez saisir un matricule correcte";
            }

            if($error == '')
            {
                $em = $this->getDoctrine()->getManager();
                $employers = $em->getRepository('GestionBundle:Employers')->findBy(array('matricule'=>$matricule));
                if($employers != null)
                {
                    return $this->render('GestionBundle:Employers:search.html.twig', array(
                        'error'=>$error,
                        'employers'=>$employers
                    ));
                }

                $error = "Aucun employer trouvé !";

                return $this->render('GestionBundle:Employers:search.html.twig', array(
                    'error'=>$error
                ));
            }

            return $this->render('GestionBundle:Employers:search.html.twig', array(
                'error'=>$error
            ));

        }
        return $this->render('GestionBundle:Employers:search.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/all", name="employer_all")
     * @Method({"GET", "POST"})
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        $lesEmployers = $em->getRepository('GestionBundle:Employers')->findAll();
        return $this->render('GestionBundle:Employers:all.html.twig', array(
            'lesEmployers' => $lesEmployers
        ));
    }

    /**
     * @Route("/edit/{id}", name="employer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $employer = $em->getRepository('GestionBundle:Employers')->find($id);
        if($employer == '')
        {
            return $this->redirectToRoute('employer_index');
        }
        $form = $this->createForm(EmployersType::class,$employer)->add('save', SubmitType::class, array('label' => 'Enregistrer'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($employer);
            $em->flush();

            $lesEmployers = $em->getRepository('GestionBundle:Employers')->findAll();

            return $this->redirectToRoute('employer_all', array('lesEmployers' => $lesEmployers));
        }

        return $this->render('GestionBundle:Employers:edit.html.twig', array(
            'form'=> $form->createView()
        ));
    }

    /**
     * @Route("/remove/{id}", name="employer_remove")
     * @Method({"GET", "POST"})
     */
    public function removeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $employer = $em->getRepository('GestionBundle:Employers')->find($id);
        if($employer == '')
        {
            return $this->redirectToRoute('employer_index');
        }
        $form = $this->createForm(EmployersType::class,$employer)->add('save', SubmitType::class, array('label' => 'Supprimer'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($employer);
            $em->flush();

            $lesEmployers = $em->getRepository('GestionBundle:Employers')->findAll();

            return $this->redirectToRoute('employer_all', array('lesEmployers' => $lesEmployers));
        }

        return $this->render('GestionBundle:Employers:remove.html.twig', array(
            'form'=> $form->createView()
        ));
    }

}
