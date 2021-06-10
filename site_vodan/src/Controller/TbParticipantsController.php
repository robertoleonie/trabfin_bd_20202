<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbParticipants Controller
 *
 * @property \App\Model\Table\TbParticipantsTable $TbParticipants
 *
 * @method \App\Model\Entity\TbParticipant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbParticipantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tbParticipants = $this->paginate($this->TbParticipants);

        $this->set(compact('tbParticipants'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Participant id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbParticipant = $this->TbParticipants->get($id, [
            'contain' => [],
        ]);

        $this->set('tbParticipant', $tbParticipant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbParticipant = $this->TbParticipants->newEntity();
        if ($this->request->is('post')) {
            $tbParticipant = $this->TbParticipants->patchEntity($tbParticipant, $this->request->getData());
            if ($this->TbParticipants->save($tbParticipant)) {
                $this->Flash->success(__('The tb participant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb participant could not be saved. Please, try again.'));
        }
        $this->set(compact('tbParticipant'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Participant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbParticipant = $this->TbParticipants->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbParticipant = $this->TbParticipants->patchEntity($tbParticipant, $this->request->getData());
            if ($this->TbParticipants->save($tbParticipant)) {
                $this->Flash->success(__('The tb participant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb participant could not be saved. Please, try again.'));
        }
        $this->set(compact('tbParticipant'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Participant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbParticipant = $this->TbParticipants->get($id);
        if ($this->TbParticipants->delete($tbParticipant)) {
            $this->Flash->success(__('The tb participant has been deleted.'));
        } else {
            $this->Flash->error(__('The tb participant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
