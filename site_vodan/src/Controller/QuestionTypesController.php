<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionTypes Controller
 *
 * @property \App\Model\Table\QuestionTypesTable $QuestionTypes
 *
 * @method \App\Model\Entity\QuestionType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $questionTypes = $this->paginate($this->QuestionTypes);

        $this->set(compact('questionTypes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionType = $this->QuestionTypes->newEntity();
        if ($this->request->is('post')) {
            $questionType = $this->QuestionTypes->patchEntity($questionType, $this->request->getData());
            if ($this->QuestionTypes->save($questionType)) {
                $this->Flash->success(__('The question type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question type could not be saved. Please, try again.'));
        }
        $this->set(compact('questionType'));
    }
}
