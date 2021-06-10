<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbListOfValues Controller
 *
 * @property \App\Model\Table\TbListOfValuesTable $TbListOfValues
 *
 * @method \App\Model\Entity\TbListOfValue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbListOfValuesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TbListTypes'],
        ];
        $tbListOfValues = $this->paginate($this->TbListOfValues);

        $this->set(compact('tbListOfValues'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb List Of Value id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbListOfValue = $this->TbListOfValues->get($id, [
            'contain' => ['TbListTypes'],
        ]);

        $this->set('tbListOfValue', $tbListOfValue);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbListOfValue = $this->TbListOfValues->newEntity();
        if ($this->request->is('post')) {
            $tbListOfValue = $this->TbListOfValues->patchEntity($tbListOfValue, $this->request->getData());
            if ($this->TbListOfValues->save($tbListOfValue)) {
                $this->Flash->success(__('The tb list of value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb list of value could not be saved. Please, try again.'));
        }
        $tbListTypes = $this->TbListOfValues->TbListTypes->find('list', ['limit' => 200]);
        $this->set(compact('tbListOfValue', 'tbListTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb List Of Value id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbListOfValue = $this->TbListOfValues->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbListOfValue = $this->TbListOfValues->patchEntity($tbListOfValue, $this->request->getData());
            if ($this->TbListOfValues->save($tbListOfValue)) {
                $this->Flash->success(__('The tb list of value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb list of value could not be saved. Please, try again.'));
        }
        $tbListTypes = $this->TbListOfValues->TbListTypes->find('list', ['limit' => 200]);
        $this->set(compact('tbListOfValue', 'tbListTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb List Of Value id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbListOfValue = $this->TbListOfValues->get($id);
        if ($this->TbListOfValues->delete($tbListOfValue)) {
            $this->Flash->success(__('The tb list of value has been deleted.'));
        } else {
            $this->Flash->error(__('The tb list of value could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
