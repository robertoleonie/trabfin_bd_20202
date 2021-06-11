<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionGroupsForms Controller
 *
 * @property \App\Model\Table\QuestionGroupsFormsTable $QuestionGroupsForms
 *
 * @method \App\Model\Entity\QuestionGroupsForm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionGroupsFormsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Crfforms', 'Questions'],
        ];
        $questionGroupsForms = $this->paginate($this->QuestionGroupsForms);

        $this->set(compact('questionGroupsForms'));
    }

    /**
     * View method
     *
     * @param string|null $id Question Groups Form id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionGroupsForm = $this->QuestionGroupsForms->get($id, [
            'contain' => ['Crfforms', 'Questions'],
        ]);

        $this->set('questionGroupsForm', $questionGroupsForm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionGroupsForm = $this->QuestionGroupsForms->newEntity();
        if ($this->request->is('post')) {
            $questionGroupsForm = $this->QuestionGroupsForms->patchEntity($questionGroupsForm, $this->request->getData());
            if ($this->QuestionGroupsForms->save($questionGroupsForm)) {
                $this->Flash->success(__('The question groups form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question groups form could not be saved. Please, try again.'));
        }
        $crfforms = $this->QuestionGroupsForms->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->QuestionGroupsForms->Questions->find('list', ['limit' => 200]);
        $this->set(compact('questionGroupsForm', 'crfforms', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Groups Form id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionGroupsForm = $this->QuestionGroupsForms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionGroupsForm = $this->QuestionGroupsForms->patchEntity($questionGroupsForm, $this->request->getData());
            if ($this->QuestionGroupsForms->save($questionGroupsForm)) {
                $this->Flash->success(__('The question groups form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question groups form could not be saved. Please, try again.'));
        }
        $crfforms = $this->QuestionGroupsForms->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->QuestionGroupsForms->Questions->find('list', ['limit' => 200]);
        $this->set(compact('questionGroupsForm', 'crfforms', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Groups Form id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionGroupsForm = $this->QuestionGroupsForms->get($id);
        if ($this->QuestionGroupsForms->delete($questionGroupsForm)) {
            $this->Flash->success(__('The question groups form has been deleted.'));
        } else {
            $this->Flash->error(__('The question groups form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
