<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questionnaires Controller
 *
 * @property \App\Model\Table\QuestionnairesTable $Questionnaires
 *
 * @method \App\Model\Entity\Questionnaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionnairesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $questionnaires = $this->paginate($this->Questionnaires);

        $this->set(compact('questionnaires'));
    }

    /**
     * View method
     *
     * @param string|null $id Questionnaire id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionnaire = $this->Questionnaires->get($id, [
            'contain' => [],
        ]);
        $this->loadModel('Crfforms');
        $crfforms = $this->Crfforms->find('all',[
            'conditions' => ['Crfforms.questionnaire_id = '.$id]
        ]);
        $this->set(['questionnaire' => $questionnaire,'crfforms' => $crfforms]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionnaire = $this->Questionnaires->newEntity();
        if ($this->request->is('post')) {
            $questionnaire = $this->Questionnaires->patchEntity($questionnaire, $this->request->getData());
            if ($this->Questionnaires->save($questionnaire)) {
                $this->Flash->success(__('The questionnaire has been saved.'));

                return $this->redirect(['action' => 'view', $questionnaire->questionnaire_id]);
            }
            $this->Flash->error(__('The questionnaire could not be saved. Please, try again.'));
        }
        $this->set(compact('questionnaire'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Questionnaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionnaire = $this->Questionnaires->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionnaire = $this->Questionnaires->patchEntity($questionnaire, $this->request->getData());
            if ($this->Questionnaires->save($questionnaire)) {
                $this->Flash->success(__('The questionnaire has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The questionnaire could not be saved. Please, try again.'));
        }
        $this->set(compact('questionnaire'));
    }

    /**
     * Deletar method
     *
     * @param string|null $id Questionnaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deletar($id = null)
    {
        
        $row = $this->Questionnaires->deletar($id);
        if($row[0] == '0'){
            $this->Flash->error(__('The questionnaire could not be deleted, it already has associated records. Try cloning it or adding a new one.'));
        } else if ($row[0] == '1'){
            $this->Flash->success(__('The questionnaire was deleted.'));
        }   
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Clone method
     *
     * @param string|null $id List Of Value id.
     * @param string|null $cloneButtonLocation Página original onde foi requisitado o clone
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function clone($id = null){
        if(!is_null($id))
            $this->Questionnaires->clone($id);
        return $this->redirect(['action' => 'index']);
    }
}
