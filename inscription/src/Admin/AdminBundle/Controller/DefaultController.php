<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Admin\AdminBundle\Entity\Licence;
use Admin\AdminBundle\Entity\fichierUpload;
use Admin\AdminBundle\Form\LicenceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function licencesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
            $licencesSenior = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "adulte", 'visible' => true, 'reduction' => false  ) );
            $licencesSeniorReduc = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "adulte", 'visible' => true, 'reduction' => true  ) );
            $licencesJeune = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "jeune", 'visible' => true, 'reduction' => false  ) );
            $licencesJeuneReduc = $em->getRepository('AdminBundle:Licence')->findBy( array('categorie' =>  "jeune", 'visible' => true, 'reduction' => true  ) );
            
            
            
            return $this->render('AdminBundle:Default:licences.html.twig',array('licencesSenior' => $licencesSenior,
                                                                                 'licencesSeniorReduc' => $licencesSeniorReduc,  
                                                                                 'licencesJeune' => $licencesJeune,
                                                                                 'licencesJeuneReduc' => $licencesJeuneReduc,
                                                                                        ));
    }

    public function licencesNonVisiblesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
            $licencesNonVisibles = $em->getRepository('AdminBundle:Licence')->findBy( array('visible' => false ) );
       
            return $this->render('AdminBundle:Default:licencesNonVisibles.html.twig',array('licencesNonVisibles' => $licencesNonVisibles,
                                                                            
                                                                                        ));
    }

    public function creerFormLicenceAction(Request $request)
    {
        $licence = new Licence();

        $form = $this->get('form.factory')->create(new LicenceType, $licence);

        if ($form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($licence);
          $em->flush();
        
          // On redirige vers la page de visualisation de l'annonce nouvellement créée
          return $this->redirect($this->generateUrl('admin_licenceCreer'));
            }

        return $this->render('AdminBundle:Default:creerFormLicence.html.twig', array(
          'form' => $form->createView(),
             ));

    }

     public function licenceCreerAction()
    {
        return $this->render('AdminBundle:Default:licenceCreer.html.twig');
    }
    
     public function modifierLicenceAction(Request $request, Licence $licence)
    {
        $form = $this->get('form.factory')->create(new LicenceType, $licence);

        if ($form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($licence);
          $em->flush();
        
          // On redirige vers la page de visualisation de l'annonce nouvellement créée
          return $this->redirect($this->generateUrl('admin_licences'));
            }

        return $this->render('AdminBundle:Default:modifierLicence.html.twig', array(
          'form' => $form->createView(),
             ));

    }

    
    public function uploadFileAction()
    {
        
        $document = new fichierUpload();
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
                        return $this->redirect($this->generateUrl('admin_gererUploadLicence'));
                    }
                    else{
                        return $this->render('AdminBundle:Default:uploadFileErreur.html.twig', array(
                        'form' => $form->createView(),
            ));
                    }
                   
                    }
            }
           
        
            }
        
        return $this->render('AdminBundle:Default:uploadFile.html.twig', array(
        'form' => $form->createView(),
            ));

    }

    public function gererUploadLicenceAction()
    {
         $em = $this->getDoctrine()->getEntityManager();
         $fichiersPresents = $em->getRepository('AdminBundle:fichierUpload')->findAll();
        return $this->render('AdminBundle:Default:gererUploadLicence.html.twig', array(
        'fichiersPresents' => $fichiersPresents,
            ));
    }


    public function supprimerUploadLicenceAction(fichierUpload $fichier)
    {
        return $this->render('AdminBundle:Default:supprimerUploadLicence.html.twig', array(
        'fichier' => $fichier,
            ));
    }

    public function suppressionEnCoursUploadLicenceAction(fichierUpload $fichier)
    {
        $em = $this->getDoctrine() ->getManager();
        $em->remove($fichier);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_gererUploadLicence'));
    }
    
}
