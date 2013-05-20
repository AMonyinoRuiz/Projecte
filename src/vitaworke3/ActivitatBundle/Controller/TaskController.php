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

        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
        // end dummy code

        $form = $this->createForm(new TaskType(), $task);
        $tag1 = new Tag();
        $tag1->name = 'tag1';
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->name = 'tag2';
        $task->getTags()->add($tag2);
        // process the form on POST
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                // ... maybe do some form processing, like saving the Task and Tag objects
            }
        }

        return $this->render('ActivitatBundle:Task:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}