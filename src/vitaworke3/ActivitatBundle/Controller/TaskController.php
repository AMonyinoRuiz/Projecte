<?php
namespace vitaworke3\ActivitatBundle\Controller;

use vitaworke3\ActivitatBundle\Entity\Task;
use vitaworke3\ActivitatBundle\Entity\Tag;
use vitaworke3\ActivitatBundle\Form\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskController extends Controller
{
    
       public function taskAction()
        {
            $em = $this->getDoctrine()->getEntityManager();
            $tasks = $em->getRepository('ActivitatBundle:Task')
            ->findAll();
            return $this->render('ActivitatBundle:Task:task.html.twig', array(
            'tasks' => $tasks
            )); 
        }


    public function newAction(Request $request)
    {
        $task = new Task();
        $tag1 = new Tag();
        $tag1->name = 'tag11111';
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->name = 'tag2';
        $task->getTags()->add($tag2);
        $form = $this->createForm(new TaskType(), $task);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($task);
                $em->flush();
                return $this->redirect(
                    $this->generateUrl('extranet_portada')
                    );
                
            }else
            {
            return $this->redirect(
                    $this->generateUrl('extranet_calendari')
                    );
            }
        }

        return $this->render('ActivitatBundle:Task:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}