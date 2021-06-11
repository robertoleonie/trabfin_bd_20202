<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionGroups Controller
 *
 * @property \App\Model\Table\QuestionGroupsTable $QuestionGroups
 *
 * @method \App\Model\Entity\QuestionGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionGroupsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $questionGroups = $this->paginate($this->QuestionGroups);

        $this->set(compact('questionGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id Question Group id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionGroup = $this->QuestionGroups->get($id, [
            'contain' => [],
        ]);

        $this->set('questionGroup', $questionGroup);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionGroup = $this->QuestionGroups->newEntity();
        if ($this->request->is('post')) {
            $questionGroup = $this->QuestionGroups->patchEntity($questionGroup, $this->request->getData());
            if ($this->QuestionGroups->save($questionGroup)) {
                $this->Flash->success(__('The question group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question group could not be saved. Please, try again.'));
        }
        $this->set(compact('questionGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionGroup = $this->QuestionGroups->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionGroup = $this->QuestionGroups->patchEntity($questionGroup, $this->request->getData());
            if ($this->QuestionGroups->save($questionGroup)) {
                $this->Flash->success(__('The question group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question group could not be saved. Please, try again.'));
        }
        $this->set(compact('questionGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionGroup = $this->QuestionGroups->get($id);
        if ($this->QuestionGroups->delete($questionGroup)) {
            $this->Flash->success(__('The question group has been deleted.'));
        } else {
            $this->Flash->error(__('The question group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
