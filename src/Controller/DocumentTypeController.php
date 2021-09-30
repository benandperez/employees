<?php

namespace App\Controller;

use App\Entity\DocumentType;
use App\Form\DocumentTypeSearchType;
use App\Form\DocumentTypeType;
use App\Form\EmployeesSearchType;
use App\Repository\DocumentTypeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/document/type")
 */
class DocumentTypeController extends AbstractController
{
    /**
     * @Route("/", name="document_type_index", methods={"GET"})
     */
    public function index(DocumentTypeRepository $documentTypeRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $form = $this->createForm(DocumentTypeSearchType::class, null);
        $form->handleRequest($request);
        $data = null;

        if (isset($request->query->get('document_type_search')['value'])){
            $data = $request->query->get('document_type_search')['value'];
        }

        if (isset($data)){
            $employees = $documentTypeRepository->findDocumentType($data);
        }else{
            $employees = $documentTypeRepository->findAll();
        }

        $pagination = $paginator->paginate(
            $employees, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->renderForm('document_type/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form
        ]);
    }

    /**
     * @Route("/new", name="document_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $documentType = new DocumentType();
        $form = $this->createForm(DocumentTypeType::class, $documentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentType->setCreatedAt(new \DateTime());
            $documentType->setUpdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documentType);
            $entityManager->flush();

            return $this->redirectToRoute('document_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document_type/new.html.twig', [
            'document_type' => $documentType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="document_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DocumentType $documentType): Response
    {
        $form = $this->createForm(DocumentTypeType::class, $documentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentType->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('document_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document_type/edit.html.twig', [
            'document_type' => $documentType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="document_type_delete", methods={"POST"})
     */
    public function delete(Request $request, DocumentType $documentType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($documentType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('document_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
