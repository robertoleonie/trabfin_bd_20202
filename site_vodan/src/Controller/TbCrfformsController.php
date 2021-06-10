<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbCrfforms Controller
 *
 * @property \App\Model\Table\TbCrfformsTable $TbCrfforms
 *
 * @method \App\Model\Entity\TbCrfform[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbCrfformsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questionnaires'],
        ];
        $tbCrfforms = $this->paginate($this->TbCrfforms);

        $this->set(compact('tbCrfforms'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Crfform id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbCrfform = $this->TbCrfforms->get($id, [
            'contain' => ['Questionnaires'],
        ]);

        $this->set('tbCrfform', $tbCrfform);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbCrfform = $this->TbCrfforms->newEntity();
        if ($this->request->is('post')) {
            $tbCrfform = $this->TbCrfforms->patchEntity($tbCrfform, $this->request->getData());
            if ($this->TbCrfforms->save($tbCrfform)) {
                $this->Flash->success(__('The tb crfform has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb crfform could not be saved. Please, try again.'));
        }
        $questionnaires = $this->TbCrfforms->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('tbCrfform', 'questionnaires'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Crfform id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbCrfform = $this->TbCrfforms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbCrfform = $this->TbCrfforms->patchEntity($tbCrfform, $this->request->getData());
            if ($this->TbCrfforms->save($tbCrfform)) {
                $this->Flash->success(__('The tb crfform has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb crfform could not be saved. Please, try again.'));
        }
        $questionnaires = $this->TbCrfforms->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('tbCrfform', 'questionnaires'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Crfform id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbCrfform = $this->TbCrfforms->get($id);
        if ($this->TbCrfforms->delete($tbCrfform)) {
            $this->Flash->success(__('The tb crfform has been deleted.'));
        } else {
            $this->Flash->error(__('The tb crfform could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
