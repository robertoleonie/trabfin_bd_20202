<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbQuestionGroupsFormsRecords Controller
 *
 * @property \App\Model\Table\TbQuestionGroupsFormsRecordsTable $TbQuestionGroupsFormsRecords
 *
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestionGroupsFormsRecordsController extends AppController
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
        $tbQuestionGroupsFormsRecords = $this->paginate($this->TbQuestionGroupsFormsRecords);

        $this->set(compact('tbQuestionGroupsFormsRecords'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Question Groups Forms Record id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestionGroupsFormsRecord = $this->TbQuestionGroupsFormsRecords->get($id, [
            'contain' => ['FormRecords', 'Crfforms', 'Questions', 'ListOfValues'],
        ]);

        $this->set('tbQuestionGroupsFormsRecord', $tbQuestionGroupsFormsRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestionGroupsFormsRecord = $this->TbQuestionGroupsFormsRecords->newEntity();
        if ($this->request->is('post')) {
            $tbQuestionGroupsFormsRecord = $this->TbQuestionGroupsFormsRecords->patchEntity($tbQuestionGroupsFormsRecord, $this->request->getData());
            if ($this->TbQuestionGroupsFormsRecords->save($tbQuestionGroupsFormsRecord)) {
                $this->Flash->success(__('The tb question groups forms record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question groups forms record could not be saved. Please, try again.'));
        }
        $formRecords = $this->TbQuestionGroupsFormsRecords->FormRecords->find('list', ['limit' => 200]);
        $crfforms = $this->TbQuestionGroupsFormsRecords->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->TbQuestionGroupsFormsRecords->Questions->find('list', ['limit' => 200]);
        $listOfValues = $this->TbQuestionGroupsFormsRecords->ListOfValues->find('list', ['limit' => 200]);
        $this->set(compact('tbQuestionGroupsFormsRecord', 'formRecords', 'crfforms', 'questions', 'listOfValues'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Question Groups Forms Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestionGroupsFormsRecord = $this->TbQuestionGroupsFormsRecords->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestionGroupsFormsRecord = $this->TbQuestionGroupsFormsRecords->patchEntity($tbQuestionGroupsFormsRecord, $this->request->getData());
            if ($this->TbQuestionGroupsFormsRecords->save($tbQuestionGroupsFormsRecord)) {
                $this->Flash->success(__('The tb question groups forms record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question groups forms record could not be saved. Please, try again.'));
        }
        $formRecords = $this->TbQuestionGroupsFormsRecords->FormRecords->find('list', ['limit' => 200]);
        $crfforms = $this->TbQuestionGroupsFormsRecords->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->TbQuestionGroupsFormsRecords->Questions->find('list', ['limit' => 200]);
        $listOfValues = $this->TbQuestionGroupsFormsRecords->ListOfValues->find('list', ['limit' => 200]);
        $this->set(compact('tbQuestionGroupsFormsRecord', 'formRecords', 'crfforms', 'questions', 'listOfValues'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Question Groups Forms Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestionGroupsFormsRecord = $this->TbQuestionGroupsFormsRecords->get($id);
        if ($this->TbQuestionGroupsFormsRecords->delete($tbQuestionGroupsFormsRecord)) {
            $this->Flash->success(__('The tb question groups forms record has been deleted.'));
        } else {
            $this->Flash->error(__('The tb question groups forms record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
