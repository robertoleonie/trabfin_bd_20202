<?php
namespace App\Controller;

use App\Controller\AppController;
//use Cake\ORM\TableRegistry;
/**
 * ListOfValues Controller
 *
 * @property \App\Model\Table\ListOfValuesTable $ListOfValues
 *
 * @method \App\Model\Entity\ListOfValue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListOfValuesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ListTypes'],
        ];
        $listOfValues = $this->paginate($this->ListOfValues);
        $this->set(compact('listOfValues'));
    }

    /**
     * View method
     *
     * @param string|null $id List Of Value id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listOfValue = $this->ListOfValues->get($id, [
            'contain' => ['ListTypes'],
        ]);

        $this->set('listOfValue', $listOfValue);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $listOfValue = $this->ListOfValues->newEntity();
        if ($this->request->is('post')) {
            $listOfValue = $this->ListOfValues->patchEntity($listOfValue, $this->request->getData());
            if ($this->ListOfValues->save($listOfValue)) {
                $this->Flash->success(__('The list of value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The list of value could not be saved. Please, try again.'));
        }
        $listTypes = $this->ListOfValues->ListTypes->find('list', ['limit' => 200]);
        $this->set(compact('listOfValue', 'listTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id List Of Value id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listOfValue = $this->ListOfValues->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listOfValue = $this->ListOfValues->patchEntity($listOfValue, $this->request->getData());
            if ($this->ListOfValues->save($listOfValue)) {
                $this->Flash->success(__('The list of value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The list of value could not be saved. Please, try again.'));
        }
        $listTypes = $this->ListOfValues->ListTypes->find('list', ['limit' => 200]);
        $this->set(compact('listOfValue', 'listTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id List Of Value id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listOfValue = $this->ListOfValues->get($id);
        if ($this->ListOfValues->delete($listOfValue)) {
            $this->Flash->success(__('The list of value has been deleted.'));
        } else {
            $this->Flash->error(__('The list of value could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
