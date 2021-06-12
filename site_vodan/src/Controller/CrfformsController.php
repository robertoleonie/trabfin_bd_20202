<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Crfforms Controller
 *
 * @property \App\Model\Table\CrfformsTable $Crfforms
 *
 * @method \App\Model\Entity\Crfform[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CrfformsController extends AppController
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
        $crfforms = $this->paginate($this->Crfforms);
        $this->set(compact('crfforms'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Crfform id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $crfform = $this->Crfforms->get($id, [
            'contain' => ['Questionnaires'],
        ]);
        //$this->set(compact('crfform'));
        $this->loadModel('QuestionGroupsForms');
        $questionGroupsForms = $this->QuestionGroupsForms->find('all',[
            'conditions' => ['QuestionGroupsForms.crfforms_id = '.$id]
        ]);
        $this->loadModel('Questions');
        $questions = $this->QuestionGroupsForms->find('all')->contain(['Questions']);           
        
        $this->set(['crfform' => $crfform,'questionGroupsForms' => $questionGroupsForms,'questions'=>$questions]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $crfform = $this->Crfforms->newEntity();
        if ($this->request->is('post')) {
            $crfform = $this->Crfforms->patchEntity($crfform, $this->request->getData());
            if ($this->Crfforms->save($crfform)) {
                $this->Flash->success(__('The crfform has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crfform could not be saved. Please, try again.'));
        }
        $questionnaires = $this->Crfforms->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('crfform', 'questionnaires'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Crfform id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $crfform = $this->Crfforms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $crfform = $this->Crfforms->patchEntity($crfform, $this->request->getData());
            if ($this->Crfforms->save($crfform)) {
                $this->Flash->success(__('The crfform has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crfform could not be saved. Please, try again.'));
        }
        $questionnaires = $this->Crfforms->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('crfform', 'questionnaires'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Crfform id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $crfform = $this->Crfforms->get($id);
        if ($this->Crfforms->delete($crfform)) {
            $this->Flash->success(__('The crfform has been deleted.'));
        } else {
            $this->Flash->error(__('The crfform could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
