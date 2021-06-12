<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FormRecords Controller
 *
 * @property \App\Model\Table\FormRecordsTable $FormRecords
 *
 * @method \App\Model\Entity\FormRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FormRecordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Participants', 'HospitalUnits', 'Questionnaires', 'Crfforms'],
        ];
        $formRecords = $this->paginate($this->FormRecords);

        $this->set(compact('formRecords'));
    }

    /**
     * View method
     *
     * @param string|null $id Form Record id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formRecord = $this->FormRecords->get($id, [
            'contain' => ['Participants', 'HospitalUnits', 'Questionnaires', 'Crfforms'],
        ]);

        $this->set('formRecord', $formRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formRecord = $this->FormRecords->newEntity();
        if ($this->request->is('post')) {
            $formRecord = $this->FormRecords->patchEntity($formRecord, $this->request->getData());
            if ($this->FormRecords->save($formRecord)) {
                $this->Flash->success(__('The form record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form record could not be saved. Please, try again.'));
        }
        $participants = $this->FormRecords->Participants->find('list', ['limit' => 200]);
        $hospitalUnits = $this->FormRecords->HospitalUnits->find('list', ['limit' => 200]);
        $questionnaires = $this->FormRecords->Questionnaires->find('list', ['limit' => 200]);
        $crfforms = $this->FormRecords->Crfforms->find('list', ['limit' => 200]);
        $this->set(compact('formRecord', 'participants', 'hospitalUnits', 'questionnaires', 'crfforms'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Form Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formRecord = $this->FormRecords->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formRecord = $this->FormRecords->patchEntity($formRecord, $this->request->getData());
            if ($this->FormRecords->save($formRecord)) {
                $this->Flash->success(__('The form record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The form record could not be saved. Please, try again.'));
        }
        $participants = $this->FormRecords->Participants->find('list', ['limit' => 200]);
        $hospitalUnits = $this->FormRecords->HospitalUnits->find('list', ['limit' => 200]);
        $questionnaires = $this->FormRecords->Questionnaires->find('list', ['limit' => 200]);
        $crfforms = $this->FormRecords->Crfforms->find('list', ['limit' => 200]);
        $this->set(compact('formRecord', 'participants', 'hospitalUnits', 'questionnaires', 'crfforms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Form Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formRecord = $this->FormRecords->get($id);
        if ($this->FormRecords->delete($formRecord)) {
            $this->Flash->success(__('The form record has been deleted.'));
        } else {
            $this->Flash->error(__('The form record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
