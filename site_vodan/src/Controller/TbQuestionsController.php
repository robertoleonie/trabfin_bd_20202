<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbQuestions Controller
 *
 * @property \App\Model\Table\TbQuestionsTable $TbQuestions
 *
 * @method \App\Model\Entity\TbQuestion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['QuestionTypes', 'ListTypes', 'QuestionGroups'],
        ];
        $tbQuestions = $this->paginate($this->TbQuestions);

        $this->set(compact('tbQuestions'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Question id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestion = $this->TbQuestions->get($id, [
            'contain' => ['QuestionTypes', 'ListTypes', 'QuestionGroups'],
        ]);

        $this->set('tbQuestion', $tbQuestion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestion = $this->TbQuestions->newEntity();
        if ($this->request->is('post')) {
            $tbQuestion = $this->TbQuestions->patchEntity($tbQuestion, $this->request->getData());
            if ($this->TbQuestions->save($tbQuestion)) {
                $this->Flash->success(__('The tb question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question could not be saved. Please, try again.'));
        }
        $questionTypes = $this->TbQuestions->QuestionTypes->find('list', ['limit' => 200]);
        $listTypes = $this->TbQuestions->ListTypes->find('list', ['limit' => 200]);
        $questionGroups = $this->TbQuestions->QuestionGroups->find('list', ['limit' => 200]);
        $this->set(compact('tbQuestion', 'questionTypes', 'listTypes', 'questionGroups'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestion = $this->TbQuestions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestion = $this->TbQuestions->patchEntity($tbQuestion, $this->request->getData());
            if ($this->TbQuestions->save($tbQuestion)) {
                $this->Flash->success(__('The tb question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question could not be saved. Please, try again.'));
        }
        $questionTypes = $this->TbQuestions->QuestionTypes->find('list', ['limit' => 200]);
        $listTypes = $this->TbQuestions->ListTypes->find('list', ['limit' => 200]);
        $questionGroups = $this->TbQuestions->QuestionGroups->find('list', ['limit' => 200]);
        $this->set(compact('tbQuestion', 'questionTypes', 'listTypes', 'questionGroups'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestion = $this->TbQuestions->get($id);
        if ($this->TbQuestions->delete($tbQuestion)) {
            $this->Flash->success(__('The tb question has been deleted.'));
        } else {
            $this->Flash->error(__('The tb question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
