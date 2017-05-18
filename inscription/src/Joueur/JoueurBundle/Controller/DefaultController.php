<?php

namespace Joueur\JoueurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Admin\AdminBundle\Entity\Licence;
use Joueur\JoueurBundle\Entity\fichierUploadJoueur;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JoueurBundle:Default:index.html.twig');
    }
    public function redirection_apresLoginAction()
    {
		$authChecker = $this->container->get('security.authorization_checker');

        if ($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->redirect($this->generateUrl('admin_homepage'));
        }
        else{
             return $this->redirect($this->generateUrl('joueur_homepage'));
        }
    }

    public function licencesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
            $licencesSenior = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "adulte", 'visible' => true, 'reduction' => false  ) );
            $licencesSeniorReduc = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "adulte", 'visible' => true, 'reduction' => true  ) );
            $licencesJeune = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "jeune", 'visible' => true, 'reduction' => false  ) );
            $licencesJeuneReduc = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "jeune", 'visible' => true, 'reduction' => true  ) );
            
            
            
            return $this->render('JoueurBundle:Default:licences.html.twig',array('licencesSenior' => $licencesSenior,
                                                                                 'licencesSeniorReduc' => $licencesSeniorReduc,  
                                                                                 'licencesJeune' => $licencesJeune,
                                                                                 'licencesJeuneReduc' => $licencesJeuneReduc,
                                                                                        ));
    }

    public function licencesInfosAction(Licence $licence)
    {
     
        return $this->render('JoueurBundle:Default:licencesInfos.html.twig',array('licence' => $licence,));
    }

    public function documentsAction()
    {
         $em = $this->getDoctrine()->getEntityManager();
         $fichiersPresents = $em->getRepository('JoueurBundle:fichierUploadJoueur')->findBy( array('IdJoueur' => $this->getUser() ));
        return $this->render('JoueurBundle:Default:documents.html.twig', array(
        'fichiersPresents' => $fichiersPresents,
            ));
    }
    
    public function uploadFileAction()
    {
        
        $document = new fichierUploadJoueur();
        $document -> setDate(new \DateTime('now'));
        $document -> setIdJoueur($this->getUser()->getId());
        $form = $this->createFormBuilder($document)
            ->add('name')
            ->add('file')
            ->getForm()
        ;

        if ($this->getRequest()->getMethod() === 'POST') {
            {
                    $form->bind($this->getRequest());
                    $verif=$document->verifExtension();
                    if ($form->isValid()) {
                    $em = $this->getDoctrine()->getEntityManager();
                    if( $verif == 1 ){
                        $em->persist($document);
                        $em->flush();
                        return $this->redirect($this->generateUrl('joueur_documents'));
                    }
                    else{
                        return $this->render('JoueurBundle:Default:uploadFileErreur.html.twig', array(
                        'form' => $form->createView(),
            ));
                    }
                   
                    }
            }
           
        
            }
        
        return $this->render('JoueurBundle:Default:uploadFile.html.twig', array(
        'form' => $form->createView(),
            ));

    }
    
}
