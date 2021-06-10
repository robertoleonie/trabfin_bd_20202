<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbQuestionnaires Controller
 *
 * @property \App\Model\Table\TbQuestionnairesTable $TbQuestionnaires
 *
 * @method \App\Model\Entity\TbQuestionnaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestionnairesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tbQuestionnaires = $this->paginate($this->TbQuestionnaires);

        $this->set(compact('tbQuestionnaires'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Questionnaire id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestionnaire = $this->TbQuestionnaires->get($id, [
            'contain' => [],
        ]);

        $this->set('tbQuestionnaire', $tbQuestionnaire);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestionnaire = $this->TbQuestionnaires->newEntity();
        if ($this->request->is('post')) {
            $tbQuestionnaire = $this->TbQuestionnaires->patchEntity($tbQuestionnaire, $this->request->getData());
            if ($this->TbQuestionnaires->save($tbQuestionnaire)) {
                $this->Flash->success(__('The tb questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb questionnaire could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestionnaire'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Questionnaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestionnaire = $this->TbQuestionnaires->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestionnaire = $this->TbQuestionnaires->patchEntity($tbQuestionnaire, $this->request->getData());
            if ($this->TbQuestionnaires->save($tbQuestionnaire)) {
                $this->Flash->success(__('The tb questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb questionnaire could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestionnaire'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Questionnaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestionnaire = $this->TbQuestionnaires->get($id);
        if ($this->TbQuestionnaires->delete($tbQuestionnaire)) {
            $this->Flash->success(__('The tb questionnaire has been deleted.'));
        } else {
            $this->Flash->error(__('The tb questionnaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
