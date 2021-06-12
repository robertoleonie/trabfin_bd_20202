<?php
namespace App\Controller;

use App\Controller\AppController;
//use Cake\ORM\TableRegistry;
/**
 * ListTypes Controller
 *
 * @property \App\Model\Table\ListTypesTable $ListTypes
 *
 * @method \App\Model\Entity\ListType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $listTypes = $this->paginate($this->ListTypes);

        $this->set(compact('listTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id List Type id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   
        $listType = $this->ListTypes->get($id, [
            'contain' => [],
        ]);
        
        $this->loadModel('ListOfValues');

        $listOfValues = $this->ListOfValues->find('all',[
            'conditions' => ['ListOfValues.list_type_id = '.$id]
        ]);
        $this->set(['listType' => $listType,'listOfValues' => $listOfValues]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $listType = $this->ListTypes->newEntity();
        if ($this->request->is('post')) {
            $listType = $this->ListTypes->patchEntity($listType, $this->request->getData());
            if ($this->ListTypes->save($listType)) {
                $this->Flash->success(__('The list type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The list type could not be saved. Please, try again.'));
        }
        $this->set(compact('listType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id List Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listType = $this->ListTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listType = $this->ListTypes->patchEntity($listType, $this->request->getData());
            if ($this->ListTypes->save($listType)) {
                $this->Flash->success(__('The list type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The list type could not be saved. Please, try again.'));
        }
        
        $this->set(compact('listType','listOfValues'));
    }

    /**
     * Delete method
     *
     * @param string|null $id List Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listType = $this->ListTypes->get($id);
        if ($this->ListTypes->delete($listType)) {
            $this->Flash->success(__('The list type has been deleted.'));
        } else {
            $this->Flash->error(__('The list type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function clone($id = null){
        //$this->ListTypes->testingquery();
        //$connection = ConnectionManager::get('default');
        //$results = $connection->query('UPDATE list_types SET description = \'teste_de_update_kkk\' WHERE list_types.list_type_id = 10');
        
        return $this->redirect(['action' => 'index']);
    }
}
