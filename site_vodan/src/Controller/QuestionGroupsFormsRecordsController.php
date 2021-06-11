<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionGroupsFormsRecords Controller
 *
 * @property \App\Model\Table\QuestionGroupsFormsRecordsTable $QuestionGroupsFormsRecords
 *
 * @method \App\Model\Entity\QuestionGroupsFormsRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionGroupsFormsRecordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FormRecords', 'Crfforms', 'Questions', 'ListOfValues'],
        ];
        $questionGroupsFormsRecords = $this->paginate($this->QuestionGroupsFormsRecords);

        $this->set(compact('questionGroupsFormsRecords'));
    }

    /**
     * View method
     *
     * @param string|null $id Question Groups Forms Record id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionGroupsFormsRecord = $this->QuestionGroupsFormsRecords->get($id, [
            'contain' => ['FormRecords', 'Crfforms', 'Questions', 'ListOfValues'],
        ]);

        $this->set('questionGroupsFormsRecord', $questionGroupsFormsRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionGroupsFormsRecord = $this->QuestionGroupsFormsRecords->newEntity();
        if ($this->request->is('post')) {
            $questionGroupsFormsRecord = $this->QuestionGroupsFormsRecords->patchEntity($questionGroupsFormsRecord, $this->request->getData());
            if ($this->QuestionGroupsFormsRecords->save($questionGroupsFormsRecord)) {
                $this->Flash->success(__('The question groups forms record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question groups forms record could not be saved. Please, try again.'));
        }
        $formRecords = $this->QuestionGroupsFormsRecords->FormRecords->find('list', ['limit' => 200]);
        $crfforms = $this->QuestionGroupsFormsRecords->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->QuestionGroupsFormsRecords->Questions->find('list', ['limit' => 200]);
        $listOfValues = $this->QuestionGroupsFormsRecords->ListOfValues->find('list', ['limit' => 200]);
        $this->set(compact('questionGroupsFormsRecord', 'formRecords', 'crfforms', 'questions', 'listOfValues'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Groups Forms Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionGroupsFormsRecord = $this->QuestionGroupsFormsRecords->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionGroupsFormsRecord = $this->QuestionGroupsFormsRecords->patchEntity($questionGroupsFormsRecord, $this->request->getData());
            if ($this->QuestionGroupsFormsRecords->save($questionGroupsFormsRecord)) {
                $this->Flash->success(__('The question groups forms record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question groups forms record could not be saved. Please, try again.'));
        }
        $formRecords = $this->QuestionGroupsFormsRecords->FormRecords->find('list', ['limit' => 200]);
        $crfforms = $this->QuestionGroupsFormsRecords->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->QuestionGroupsFormsRecords->Questions->find('list', ['limit' => 200]);
        $listOfValues = $this->QuestionGroupsFormsRecords->ListOfValues->find('list', ['limit' => 200]);
        $this->set(compact('questionGroupsFormsRecord', 'formRecords', 'crfforms', 'questions', 'listOfValues'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Groups Forms Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionGroupsFormsRecord = $this->QuestionGroupsFormsRecords->get($id);
        if ($this->QuestionGroupsFormsRecords->delete($questionGroupsFormsRecord)) {
            $this->Flash->success(__('The question groups forms record has been deleted.'));
        } else {
            $this->Flash->error(__('The question groups forms record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
