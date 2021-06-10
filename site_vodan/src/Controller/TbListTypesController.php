<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbListTypes Controller
 *
 * @property \App\Model\Table\TbListTypesTable $TbListTypes
 *
 * @method \App\Model\Entity\TbListType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbListTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tbListTypes = $this->paginate($this->TbListTypes);

        $this->set(compact('tbListTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb List Type id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbListType = $this->TbListTypes->get($id, [
            'contain' => [],
        ]);

        $this->set('tbListType', $tbListType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbListType = $this->TbListTypes->newEntity();
        if ($this->request->is('post')) {
            $tbListType = $this->TbListTypes->patchEntity($tbListType, $this->request->getData());
            if ($this->TbListTypes->save($tbListType)) {
                $this->Flash->success(__('The tb list type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb list type could not be saved. Please, try again.'));
        }
        $this->set(compact('tbListType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb List Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbListType = $this->TbListTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbListType = $this->TbListTypes->patchEntity($tbListType, $this->request->getData());
            if ($this->TbListTypes->save($tbListType)) {
                $this->Flash->success(__('The tb list type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb list type could not be saved. Please, try again.'));
        }
        $this->set(compact('tbListType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb List Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbListType = $this->TbListTypes->get($id);
        if ($this->TbListTypes->delete($tbListType)) {
            $this->Flash->success(__('The tb list type has been deleted.'));
        } else {
            $this->Flash->error(__('The tb list type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
