<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbQuestionGroupsForms Controller
 *
 * @property \App\Model\Table\TbQuestionGroupsFormsTable $TbQuestionGroupsForms
 *
 * @method \App\Model\Entity\TbQuestionGroupsForm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestionGroupsFormsController extends AppController
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
        $tbQuestionGroupsForms = $this->paginate($this->TbQuestionGroupsForms);

        $this->set(compact('tbQuestionGroupsForms'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Question Groups Form id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestionGroupsForm = $this->TbQuestionGroupsForms->get($id, [
            'contain' => ['Crfforms', 'Questions'],
        ]);

        $this->set('tbQuestionGroupsForm', $tbQuestionGroupsForm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestionGroupsForm = $this->TbQuestionGroupsForms->newEntity();
        if ($this->request->is('post')) {
            $tbQuestionGroupsForm = $this->TbQuestionGroupsForms->patchEntity($tbQuestionGroupsForm, $this->request->getData());
            if ($this->TbQuestionGroupsForms->save($tbQuestionGroupsForm)) {
                $this->Flash->success(__('The tb question groups form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question groups form could not be saved. Please, try again.'));
        }
        $crfforms = $this->TbQuestionGroupsForms->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->TbQuestionGroupsForms->Questions->find('list', ['limit' => 200]);
        $this->set(compact('tbQuestionGroupsForm', 'crfforms', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Question Groups Form id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestionGroupsForm = $this->TbQuestionGroupsForms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestionGroupsForm = $this->TbQuestionGroupsForms->patchEntity($tbQuestionGroupsForm, $this->request->getData());
            if ($this->TbQuestionGroupsForms->save($tbQuestionGroupsForm)) {
                $this->Flash->success(__('The tb question groups form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question groups form could not be saved. Please, try again.'));
        }
        $crfforms = $this->TbQuestionGroupsForms->Crfforms->find('list', ['limit' => 200]);
        $questions = $this->TbQuestionGroupsForms->Questions->find('list', ['limit' => 200]);
        $this->set(compact('tbQuestionGroupsForm', 'crfforms', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Question Groups Form id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestionGroupsForm = $this->TbQuestionGroupsForms->get($id);
        if ($this->TbQuestionGroupsForms->delete($tbQuestionGroupsForm)) {
            $this->Flash->success(__('The tb question groups form has been deleted.'));
        } else {
            $this->Flash->error(__('The tb question groups form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
